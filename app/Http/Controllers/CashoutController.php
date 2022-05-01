<?php

namespace App\Http\Controllers;

use App\Models\cashoutRequest;
use App\Models\da_info;
use App\Models\Item;
use App\Models\Location;
use App\Models\payment;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Humans\Semaphore\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CashoutController extends Controller
{
    public function index(Request $request)
    {
        $items = cashoutRequest::selectRaw('	cashout_requests.id,cashout_requests.code as code,
	cashout_requests.date as date,
	users.name as name,
	(
	SELECT
		SUM( items.amount )
	FROM
		payments
		LEFT JOIN items ON payments.item_id = items.id
	WHERE
		cashout_id IS NULL
		AND items.seller_id = cashout_requests.seller_id
	) AS amount,
	cashout_statuses.`status`,
	cashout_requests.`status` as status_id
	')
            ->leftJoin('users', 'cashout_requests.seller_id', '=', 'users.id')
            ->leftJoin('cashout_statuses', 'cashout_requests.status','cashout_statuses.id');
        if (auth()->user()->hasRole('Admin')) {
            $items = $items->get();
        } elseif (auth()->user()->hasRole('da')) {
            $da_loc = da_info::where('da_id', Auth::id())->firstOrFail()->location_id;
            $items = $items->where('users.location_id', '=', $da_loc)->get();
        } else {
            $items = $items->where('cashout_requests.seller_id', '=', auth()->id())->get();
        }
//        $items = cashoutRequest::select('cashout_requests.code', 'cashout_requests.date', 'users.name', 'cashout_statuses.status')
//            ->leftJoin('users','cashout_requests.id','=','users.id')
//            ->leftJoin('cashout_statuses','cashout_requests.status','=','cashout_statuses.id')
//            ->addSelect(
//                [
//                    'amount' =>
//                        payment::select('items.amount')
//                            ->leftJoin('items','payments.item_id','=','items.id')
//                            ->whereNull('cashout_id')
//                            ->where('items.seller_id','=','cashout_requests.seller_id')
//                            ->sum('items.amount')
//                ]
//            )
//            ->get();
        return view('cashoutrequest', [
            'items' => $items
        ]);
    }

    public function CreatePayOutRequest()
    {
        try {
            $cashoutrequest = new cashoutRequest();
            $cashoutrequest->code = $this->createCode(Auth::user()->location_id);
            $cashoutrequest->seller_id = Auth::user()->id;
            $cashoutrequest->date = Carbon::now();

            if ($cashoutrequest->save()) {
                notify()->success('Cashout Request successfully added');
                return back();
            }

        } catch (\Exception $e) {
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }

    }

    private function createCode($id)
    {
        $loc_code = Location::find($id)->code;
        $number = sprintf('%04d', self::getNextId());
        $now = Carbon::now();
        return $loc_code . '-' . $number . '-' . $now->format('md');
    }

    public function getNextId()
    {
        $current_id = cashoutRequest::orderBy('id', 'DESC')->first();
        if (isset($current_id->id)) {
            return $current_id->id + 1;
        } else {
            return 1;
        }
    }

    public function updateCashOutRequestStatus(Request $request)
    {

        try {
            $this->validate($request, [
                'id' => 'required',
                'status' => 'required',
            ]);

            $message = '';

            $cr = cashoutRequest::findOrFail($request->id);
            $seller = User::findOrFail($cr->seller_id);
            $client = new Client(config('sms.key'), 'SEMAPHORE');
            switch ($request->status) {
                case 1:
                    $code = random_int(100000, 999999);
                    $sms_message = 'Your Cashout request has been approved by the DA'.PHP_EOL;
                    $sms_message .= 'Cashout Verification Code:'.$code;
                    $client->message()->send($seller->phone_number, $sms_message);
                    $message = 'Request successfully approved';
                    $cr->status = 1;
                    $cr->verification_code = $code;
                    break;
                case 2:
                    $v_code = $cr->verification_code;
                    if($request->verfication_code === $v_code){
                    $items = payment::select('items.id')
                        ->leftJoin('items','payments.item_id','=','items.id')
                        ->where('payments.seller_id', $cr->seller_id);
                    $sms_message = 'Cashout Request has been successfully claimed'.PHP_EOL;
                    $client->message()->send($seller->phone_number, $sms_message);
                    $items->update(['cashout_id'=>$cr->id]);

                    Item::select('id')
                        ->whereIn('id',$items->get()->toArray())
                        ->update(
                            [
                                'status_id'=>'6',
                                'release_date'=>Carbon::now()
                            ]);

                    $message = 'Request successfully Released';

                    $cr->status = 2;
                    }else{
                        $message = 'Wrong Verification code';
                        notify()->error($message);
                        return back();
                    }
                    break;
                case 3:
                    $sms_message = 'Your Cashout request has been rejected by the DA';
                    $cr->status = 3;
                    $client->message()->send($seller->phone_number, $sms_message);
                    $message = 'Request Rejected';
                    break;
            }

            if ($cr->save()) {
                notify()->success($message);
                return back();
            }
        } catch (\Exception $e) {
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }

    }
}
