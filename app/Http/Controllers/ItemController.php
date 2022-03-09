<?php

namespace App\Http\Controllers;

use App\Models\Item;

use App\Models\transactionFee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request){
        return self::getNextId();
    }

    public function saveItem(Request $request)
    {
        try {
            //Get fees
            $base_fee = transactionFee::find(1)->amount;
            $size_catergory_fee = transactionFee::find($request->size)->amount;
            $weight_base_fee = transactionFee::find(2)->amount;
            //Formula for calculating fees
            $fee =  $base_fee + $size_catergory_fee + ($weight_base_fee * $request->weight);

            $item = new Item();

            $item->date = Carbon::now();
            $item->seller_id = $request->seller_id;
            $item->buyer_id = $request->buyer_id;
            $item->origin = $request->origin;
            $item->destination = $request->destination;

            $item->amount = $request->title;
            $item->status = $request->title;
            $item->payment_status = $request->title;
            $item->approval_status = $request->title;

            if ($item->save()) {
                return response()->json(['status' => 'success', 'message' => 'Item created successfully']);
            }

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function updateItemDetails(Request $request, $id){
        try {
            $item = Item::query()->findOrFail($request->id);
            $item->buyer_id = $request->buyer_id;
            $item->origin = $request->origin;
            $item->destination = $request->destination;
            $item->fee = $request->fee;

            if ($item->save()) {
                return response()->json(['status' => 'success', 'message' => 'Item details updated successfully']);
            }

        }catch (\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function claimItem(Request $request){
        try {
            $item = Item::query()->findOrFail($request->id);
            $item->claimed_date = Carbon::now();

            if ($item->save()) {
                return response()->json(['status' => 'success', 'message' => 'Item claimed successfully']);
            }
        }catch (\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function releaseItemPayment(Request $request){
        try {
            $item = Item::query()->findOrFail($request->id);
            $item->release_date = Carbon::now();

            if ($item->save()) {
                return response()->json(['status' => 'success', 'message' => 'Item payment release successfully']);
            }
        }catch (\Exception $e){

        }
    }

    private function getNextId(){
        $id = Item::orderBy('id', 'DESC')->first()->id;
        return $id+1;
    }
}
