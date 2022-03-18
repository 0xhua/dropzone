<?php

namespace App\Http\Controllers;

use App\Models\Item;

use App\Models\item_size;
use App\Models\Location;
use App\Models\paid_status;
use App\Models\transactionFee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\isNull;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        return self::getNextId();
    }

    public function saveItem(Request $request)
    {

        try {
            //Get fees
            $base_fee = transactionFee::find(1)['amount'];
            $size_catergory_fee = transactionFee::where('size_id', $request->size)->first();
            $weight_base_fee = transactionFee::find(2)->amount;
            //Formula for calculating fees
            $fee = $base_fee + $size_catergory_fee->amount + ($weight_base_fee * 10);
            $item = new Item();

            $item->code = self::generateCode($request->origin_id);
            $item->date = Carbon::now();
            $item->seller_id = $request->seller_id;
            $item->buyer_id = $request->buyer_id;
            $item->origin_id = $request->origin_id;
            $item->destination_id = $request->destination_id;
            $item->fee = $fee;
            $item->amount = $request->amount;
            $item->payment_status_id = $request->payment_status_id;

            if ($item->save()) {
                notify()->success('Hi ' . $request->name . ', welcome to codelapan');
                return back();
//                return response()->json(['status' => 'success', 'message' => 'Item created successfully']);
            }

        } catch (\Exception $e) {
            notify()->success($e->getMessage());
            return back()->withErrors($e->getMessage());
//            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function updateItemDetails(Request $request, $id)
    {
        try {
            $item = Item::query()->findOrFail($request->id);
            $item->buyer_id = $request->buyer_id;
            $item->origin = $request->origin;
            $item->destination = $request->destination;
            $item->fee = $request->fee;

            if ($item->save()) {
                return response()->json(['status' => 'success', 'message' => 'Item details updated successfully']);
            }

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function claimItem(Request $request)
    {
        try {
            $item = Item::query()->findOrFail($request->id);
            $item->claimed_date = Carbon::now();

            if ($item->save()) {
                return response()->json(['status' => 'success', 'message' => 'Item claimed successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function releaseItemPayment(Request $request)
    {
        try {
            $item = Item::query()->findOrFail($request->id);
            $item->release_date = Carbon::now();

            if ($item->save()) {
                return response()->json(['status' => 'success', 'message' => 'Item payment release successfully']);
            }
        } catch (\Exception $e) {

        }
    }

    public function seller_dashboard()
    {
        smilify('success', 'You are successfully reconnected');
        return view('seller_dashboard');
    }

    public function seller_itemlist()
    {
        $location = Location::orderby('id', 'asc')->get();
        $sizes = item_size::orderby('id', 'asc')->get();
        $paid_statuses = paid_status::orderby('id', 'asc')->get();
        $items = DB::table('items')
            ->select('items.code', 'items.date as drop_date', 'items.origin_id',
                DB::raw('(SELECT users.`name` FROM users LEFT JOIN items ON users.id = items.seller_id LIMIT 1) as seller'),
                DB::raw('( SELECT users.`name` FROM users LEFT JOIN items ON users.id = items.buyer_id LIMIT 1) AS buyer'),
                'o.area as origin', 'd.area as destination',
                'items.fee', 'items.amount', 'paid_statuses.status as payment_status', 'item_statuses.status as status', 'approval_statuses.status as approval_status')
            ->leftJoin('approval_statuses', 'items.approval_status_id', '=', 'approval_statuses.id')
            ->leftJoin('paid_statuses', 'items.payment_status_id', '=', 'paid_statuses.id')
            ->leftJoin('item_statuses', 'items.status_id', '=', 'item_statuses.id')
            ->leftJoin('locations as o', 'items.destination_id', '=', 'o.id')
            ->leftJoin('locations as d', 'd.id', '=', 'items.origin_id')
            ->leftJoin('users', 'items.buyer_id', '=', 'users.id')
            ->get();

        return view('seller_itemList',
            [
                'location' => $location,
                'sizes' => $sizes,
                'paid_statuses' => $paid_statuses,
                'items' => $items
            ]);
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
        return view('seller_itemList', $qr);
    }

    private function getNextId()
    {
        $current_id = Item::orderBy('id', 'DESC')->first();
        if (!$current_id->id) {
            $id = 0;
        } else {
            $id = $current_id->id;
        }
        return $id + 1;
    }

    private function generateCode($area)
    {
        $loc_code = Location::find($area)->code;
        $number = sprintf('%04d', self::getNextId());
        $now = Carbon::now();
        return $loc_code . '-' . $number . '-' . $now->format('md');
    }

    private function createItemRequest()
    {

    }

}
