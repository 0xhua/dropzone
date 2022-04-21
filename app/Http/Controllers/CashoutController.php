<?php

namespace App\Http\Controllers;

use App\Models\cashoutRequest;
use App\Models\Item;
use App\Models\Location;
use App\Models\payment;
use Auth;
use Carbon\Carbon;
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
	cashout_requests.`status` ')
            ->leftJoin('users', 'cashout_requests.id', '=', 'users.id')
            ->where('cashout_requests.seller_id', '=', 5)
            ->get();
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

            $cr = cashoutRequest::query()->findOrFail($request->id);

            switch ($request->status) {
                case 1:
                    $cr->status = 1;
                    $message = 'Request successfully approved';
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
