<?php

namespace App\Http\Controllers;

use App\Helpers\SmsApiHelper;
use App\Models\da_info;
use App\Models\Item;

use App\Models\item_size;
use App\Models\itemRequest;
use App\Models\Location;
use App\Models\paid_status;
use App\Models\payment;
use App\Models\transactionFee;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use function PHPUnit\Framework\isNull;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Admin|seller|da']);
    }
    public function index(Request $request)
    {
        return self::getNextId();
    }

    public function saveItem(Request $request)
    {

        try {
            //Get fees
            $dropping_fee = transactionFee::find(1)['amount'];
            $transfer_fee = 0;
            $size_catergory_fee = transactionFee::select('transaction_fees.amount')
                ->leftJoin('item_sizes','item_sizes.id','=','transaction_fees.size_id')
                ->where('item_sizes.id','=',$request->itemSize)
                ->first();
            if($request->origin_id !== $request->destination_id){
                $transfer_fee = $size_catergory_fee->amount + 10;
            }
            $weight_base_fee = transactionFee::find(2)->amount;


            //Formula for calculating fees
            $fee = $dropping_fee + $size_catergory_fee->amount + ($weight_base_fee * 10);
            $item = new Item();
            $item->date = Carbon::now();
            $item->seller_id = (auth()->user()->hasRole('seller'))?Auth::id():$request->seller_id;
            $item->buyer_id = $request->buyer_id;
            if (auth()->user()->hasRole('da')) {
                $da_loc = Auth::user();
                $code = self::generateCode($da_loc->location_id);
                $item->current_location_id = $da_loc->location_id;
                $item->code = $code;
                $item->origin_id = $da_loc->location_id;
            } else {
                $code = self::generateCode($request->origin_id);
                $item->code = $code;
                $item->current_location_id = $request->origin_id;
                $item->origin_id = $request->origin_id;
            }
            $item->destination_id = $request->destination_id;
            $item->tf = $transfer_fee;
            $item->df = $dropping_fee;
            $item->fee = $dropping_fee + $transfer_fee;
            $item->amount = $request->amount;
            $item->payment_status_id = $request->payment_status_id;
            $item->approval_status_id = 2;


            if ($item->save()) {

                $path = storage_path() . 'public/qr_codes/';
                File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

                $image = QrCode::format('png')
                    ->size(200)->errorCorrection('H')
                    ->generate($code);
                $output_file = 'public/qr_codes/' . $code . '.png';
                Storage::disk('local')->put($output_file, $image);
                if($request->wantsJson()){
                    return response()->json(['status' => 'success', 'message' => 'Item created successfully']);
                }
                notify()->success('Item successfully added');
                return back();

            }

        } catch (\Exception $e) {
            if($request->wantsJson()){
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }
//item update = buyer, destination amount payment
    public function updateItemDetails(Request $request)
    {
        try {
            $item = Item::query()->findOrFail($request->id);
            $item->buyer_id =$request->input('buyer_id', $item->buyer_id);
            $item->destination_id = $request->input('destination_id', $item->destination_id);
            $item->amount = $request->input('amount', $item->amount);

            if ($item->save()) {
                notify()->success('Item successfully updated');
                return back();
//                return response()->json(['status' => 'success', 'message' => 'Item details updated successfully']);
            }

        } catch (\Exception $e) { notify()->error($e->getMessage());
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
//            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function claimItem(Request $request)
    {
        try {
            $item = Item::query()->findOrFail($request->id);
            $item->status_id = 1;
            $item->claimed_date = Carbon::now();

            if ($item->save()) {
                notify()->success('Item successfully claimed');
                return back();
            }

        } catch (\Exception $e) {
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }

    public function releaseItemPayment(Request $request)
    {
        try {
            $item = Item::query()->findOrFail($request->id);
            $item->release_date = Carbon::now();

            if ($item->save()) {
                notify()->success('Item successfully updated to paid');
                return back();
            }

        } catch (\Exception $e) {
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }

    public function dashboard(Request $request)
    {
        $collection = 0;
        $sellers = 0;
        if (auth()->user()->hasRole('Admin')) {
            $total_items = Item::all()->count();
            $pickup = Item::where('status_id', '=', '4')->count();
            $pullout = Item::where('status_id', '=', '3')->count();
            $in_transit = Item::where('status_id', '=', '2')->count();
            $pending = itemRequest::wherenull('status_id')->count();
            $collection = DB::table('payments')
                ->select('items.amount')
                ->leftJoin('items', 'payments.item_id', '=', 'items.id')
                ->whereNull('cashout_id')
                ->sum('amount');
           $income = Item::where('date',Carbon::today())
                   ->where('status_id','1')
                   ->sum('tf')+Item::where('date',Carbon::today())
                   ->where('status_id','1')
                   ->sum('df');
            $sellers = User::with(array('Roles' => function($query) {
                                    $query->where('name','sellers');
                                }))
                ->count();
        } elseif (auth()->user()->hasRole('da')) {

            $da_loc =Auth::user();
            $total_items = Item::where('current_location_id', '=', Auth::user()->location_id)->count();
            $pickup = Item::where('current_location_id', '=', $da_loc->location_id)
                ->where('status_id', '=', '4')
                ->count();
            $pullout = Item::where('origin_id', '=', $da_loc->location_id)
                ->where('status_id', '=', '3')
                ->count();
            $in_transit = Item::where('origin_id', '=', $da_loc->location_id)
                ->where('status_id', '=', '2')
                ->count();
            $pending = itemRequest::where('location_id', '=', $da_loc->location_id)
                ->wherenull('status_id')
                ->count();
            $collection =
                DB::table('payments')
                    ->select('items.amount')
                    ->leftJoin('items', 'payments.item_id', '=', 'items.id')
                    ->whereNull('cashout_id')
                    ->where('items.current_location_id', '=', $da_loc->location_id)
                    ->sum('amount');
            $income = Item::where('items.current_location_id', '=', Auth::user()->location_id)
                ->where('date',Carbon::today())
                ->where('payment_status_id','1')
                ->sum('tf')+Item::where('items.origin_id', '=', Auth::user()->location_id)
                    ->where('date',Carbon::today())
                    ->where('payment_status_id','1')
                    ->sum('df');
            $sellers = User::whereHas('roles', function($q) {
                $q->whereName('seller');
            })->where('users.location_id',$da_loc->location_id)

                ->count();

        } else {
            $total_items = Item::where('seller_id', '=', auth()->id())->count();
            $pickup = Item::where('seller_id', '=', auth()->id())
                ->where('status_id', '=', '4')
                ->count();
            $pullout = Item::where('seller_id', '=', auth()->id())
                ->where('status_id', '=', '3')
                ->count();
            $in_transit = Item::where('seller_id', '=', auth()->id())
                ->where('status_id', '=', '2')
                ->count();
            $pending = itemRequest::where('seller_id', '=', auth()->id())
                ->wherenull('status_id')
                ->count();
            $income = DB::table('payments')
                ->select('items.amount')
                ->leftJoin('items', 'payments.item_id', '=', 'items.id')
                ->whereNull('cashout_id')
                ->where('items.seller_id', '=', auth()->id())
                ->sum('amount');
        }

        if($request->wantsJson()){
            return response()->json(
                [
                    'total_items' => $total_items,
                    'pick_up' => $pickup,
                    'pull_out' => $pullout,
                    'in_transit' => $in_transit,
                    'pending' => $pending,
                    'income' => $income
                ], 200);
        }
        return view('dashboard',
            [
                'total_items' => $total_items,
                'pick_up' => $pickup,
                'pull_out' => $pullout,
                'in_transit' => $in_transit,
                'pending' => $pending,
                'income' => $income,
                'collection'=>$collection,
                'sellers'=>$sellers
            ]
        );
    }

    public function itemlist(Request $request)
    {
        $location = Location::orderby('id', 'asc')->get();
        $sizes = item_size::orderby('id', 'asc')->get();
        $paid_statuses = paid_status::orderby('id', 'asc')->get();
        $items = Item::query();
        $da_loc = null;
        $items = $items
            ->select(
                'items.id',
                'items.code',
                'items.date as drop_date',
                'items.origin_id',
                'buyer.name as buyer',
                'seller.name as seller',
                'o.area as origin',
                'd.area as destination',
                'items.fee', 'items.amount',
                'paid_statuses.status as payment_status',
                'item_statuses.status as status',
                'approval_statuses.status as approval_status',
                'items.approval_status_id',
                'items.payment_status_id',
                'items.claimed_date',
                'items.status_id',
                'items.release_date',
                'items.destination_id',
                'items.origin_id',
                'c.area as current_location',
                'items.tf',
                'items.df'
            )
            ->leftJoin('approval_statuses', 'items.approval_status_id', '=', 'approval_statuses.id')
            ->leftJoin('paid_statuses', 'items.payment_status_id', '=', 'paid_statuses.id')
            ->leftJoin('item_statuses', 'items.status_id', '=', 'item_statuses.id')
            ->leftJoin('locations as o', 'items.origin_id', '=', 'o.id')
            ->leftJoin('locations as d', 'd.id', '=', 'items.destination_id')
            ->leftJoin('locations as c', 'c.id', '=', 'items.current_location_id')
            ->leftJoin('users as buyer', 'items.buyer_id', '=', 'buyer.id')
            ->leftJoin('users as seller', 'items.seller_id', '=', 'seller.id')->orderBy('date', 'DESC');
        if (auth()->user()->hasRole('da')) {
            $da_loc =  Auth::user()->location_id;
            $items = $items->where('current_location_id', '=', $da_loc)
                ->orWhereNull('current_location_id')
                ->orWhere('destination_id', '=', $da_loc)
                ->orWhere('origin_id', '=', $da_loc);
        } elseif(auth()->user()->hasRole('seller')) {
            $items = $items->where('items.seller_id', '=', auth()->id());
        }

        if(!is_null($request->search)){
                $items = $items->where('buyer.name', 'like', '%' . $request->search . '%');
        }


        $show_released = false;
        if(!is_null($request->released)){
                $items = $items->where('items.status_id', '=',6);
            $show_released = true;
        }



        $buyers = User::where('seller_id',auth()->id())->whereHas(
            'roles', function ($q) {
            $q->where('name', 'buyer');
        }
        )->get();

        $sellers = User::whereHas(
            'roles', function ($q) {
            $q->where('name', 'seller');
        }
        )->get();




        if($request->wantsJson()){
            $items=$items->get();
            return response()->json(
                [
                    'location' => $location,
                    'sizes' => $sizes,
                    'paid_statuses' => $paid_statuses,
                    'items' => $items,
                    'buyers' => $buyers,
                    'sellers' => $sellers,
                    'da_loc' => $da_loc
                ], 200);
        }
        $items = $items->paginate(20);
        return view('itemList',  [
            'location' => $location,
            'sizes' => $sizes,
            'paid_statuses' => $paid_statuses,
            'items' => $items,
            'buyers' => $buyers,
            'sellers' => $sellers,
            'da_loc' => $da_loc,
            'show_released'=>$show_released
        ])
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function generateItemQr(Request $request)
    {
        $path = public_path() . 'item/qr';
        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $qr = \QrCode::size(500)
            ->format('png')
            ->generate($request->code, public_path($path . '/' . $request->code));
        return view('itemList', $qr);
    }

    public function getNextId()
    {
        $current_id = Item::orderBy('id', 'DESC')->first();
        if (isset($current_id->id)) {
            return $current_id->id + 1;
        } else {
            return 1;
        }
    }

    public function generateCode($area = 1)
    {
        $loc_code = Location::find($area)->code;
        $number = sprintf('%04d', self::getNextId());
        $now = Carbon::now();
        return $loc_code . '-' . $number . '-' . $now->format('md');
    }

    public function approveItem(Request $request)
    {
        try {
            $item = Item::query()->findOrFail($request->id);
            $item->approval_status_id = 1;
            if ($item->save()) {
                notify()->success('Item successfully approved');
                return back();
            }

        } catch (\Exception $e) {
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }

    public function markAsPaid(Request $request)
    {
        try {
            $item = Item::query()->findOrFail($request->id);
            $item->payment_status_id = 1;
            if ($item->save()) {
                notify()->success('Item successfully updated to paid');
                return back();
            }

        } catch (\Exception $e) {
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }

    public function pullOut(Request $request)
    {
        try {
            $item = Item::query()->findOrFail($request->id);
            $item->status_id = 3;
            if ($item->save()) {
                notify()->success('Item successfully pulled out');
                return back();
            }

        } catch (\Exception $e) {
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }

    public function scanItem(Request $request)
    {
        try {
            $item = Item::query();
            $item = $item
                ->select(
                    'items.id',
                    'items.code',
                    'items.date as drop_date',
                    'items.origin_id',
                    'buyer.name as buyer',
                    'seller.name as seller',
                    'o.area as origin',
                    'd.area as destination',
                    'items.fee', 'items.amount',
                    'paid_statuses.status as payment_status',
                    'item_statuses.status as status',
                    'approval_statuses.status as approval_status',
                    'items.approval_status_id',
                    'items.payment_status_id',
                    'items.claimed_date',
                    'items.status_id'
                )
                ->leftJoin('approval_statuses', 'items.approval_status_id', '=', 'approval_statuses.id')
                ->leftJoin('paid_statuses', 'items.payment_status_id', '=', 'paid_statuses.id')
                ->leftJoin('item_statuses', 'items.status_id', '=', 'item_statuses.id')
                ->leftJoin('locations as o', 'items.destination_id', '=', 'o.id')
                ->leftJoin('locations as d', 'd.id', '=', 'items.origin_id')
                ->leftJoin('users as buyer', 'items.buyer_id', '=', 'buyer.id')
                ->leftJoin('users as seller', 'items.seller_id', '=', 'seller.id')
                ->where('items.code', '=', $request->code)
                ->first();
            return response()->json(['status' => 'success', 'data' => $item]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }

    }

    public function downloadQr(Request $request)
    {
        $output_file = 'public/qr_codes/' . $request->code . '.png';
        $file = Storage::disk('local')->get($output_file);

        return (new Response($file, 200))
            ->header('Content-Type', 'image/png');
    }

    public function updateItemStatus(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required',
                'status' => 'required',
            ]);

            $message = '';
            $receiver = '';
            $item = Item::query()->findOrFail($request->id);
            switch ($request->status) {
                case 1://set status to in approved
                    $item->approval_status_id = 1;
                    $message = 'Item successfully approved';
                    break;
                case 2://set status to in transit
                    $item->status_id = 2;
                    $item->current_location_id = null;
                    $message = 'Item successfully sent out';
                    break;
                case 3://set status to ready
                    $buyer = User::findOrFail($item->buyer_id);
                    $receiver = $buyer->phone_number;
                    $seller = User::findOrFail($item->seller_id);
                    $sms_message = "Hello ".$buyer->name.", Your Item ".$item->code." from ".$seller->name." is now ready for pickup.";
                    if($item->payment_status_id == 2){
                        $sum = Item::where('id','=',$item->id)->sum(\DB::raw('tf + df + amount'));
                        $sms_message .= PHP_EOL . "Please prepare exact amount of ₱" . $sum;
                    }
                    $item->current_location_id = $item->destination_id;
                    $item->status_id = 4;
                    $message = 'Item marked as ready';
                    break;
                case 4://set status to transferred
                    $item->current_location_id = $item->destination_id;
                    $item->status_id = 5;
                    $message = 'Item sucessfully transfered';
                    break;
                case 5://set payment status to paid
                    $seller = User::findOrFail($item->seller_id);
                    $receiver = $seller->phone_number;
                    $sms_message = "Item ".$item->code." has successfully claimed by the buyer";
                    $payment = new payment();
                    $payment->date = Carbon::now();
                    $payment->seller_id = $item->seller_id;
                    $payment->item_id = $item->id;
                    $payment->save();
                    $item->payment_status_id = 1;
                    $message = 'Item sucessfully paid';
                    break;
                case 6://set item status to claimed
                    $item->status_id = 1;
                    $item->claimed_date = Carbon::now();
                    $message = 'Item sucessfully claimed';
                    break;
                case 7://set item status to PULLOUT
                    $item->status_id = 3;
                    $message = 'Item sucessfully pulled-out';
                    break;
                case 8://set item status to released
                    $item->status_id = 6;
                    $item->release_date = Carbon::now();
                    $message = 'Item sucessfully payment released';
                    break;
            }

            if ($item->save()) {
                if(!empty($sms_message)){
                    app(SmsApiHelper::class)->send_sms($receiver,$sms_message);
                }
                notify()->success($message);
                return back();
            }

        } catch (\Exception $e) {
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }

    public function da_scanner(){
        return view('da_scanner');
    }
}
