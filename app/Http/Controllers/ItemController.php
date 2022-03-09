<?php

namespace App\Http\Controllers;

use App\Models\Item;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(){

        return self::getNextId();
    }

    public function store(Request $request)
    {
        try {
            $item = new Item();
            $item->date = Carbon::now();
            $item->seller_id = $request->title;
            $item->buyer_id = $request->title;
            $item->origin = $request->title;
            $item->destination = $request->title;
            $item->fee = $request->title;
            $item->amount = $request->title;
            $item->claimed_date = $request->title;
            $item->release_date = $request->title;
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

    private function getNextId(){
        $id = Item::orderBy('id', 'DESC')->first()->id;
        return $id+1;
    }
}
