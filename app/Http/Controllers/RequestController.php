<?php

namespace App\Http\Controllers;

use App\Models\itemRequest;
use App\Models\Location;
use App\Models\requestCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'category' => 'required',
                'seller_id' => 'required',
                'contact_no' => ['required', 'regex:/(09)|(9)[0-9]{9}/'],
                'itemRequest' => 'required',
                'location' => 'required'
            ]);
            $itemRequest = new itemRequest();
            $itemRequest->date = Carbon::now();
            $itemRequest->category = $request->category;
            $itemRequest->seller_id = $request->seller_id;
            $itemRequest->contact_no = $request->contact_no;
            $itemRequest->request = $request->itemRequest;
            $itemRequest->location_id = Location::find($request->location)->id;
            $itemRequest->fee = 20;
            $itemRequest->status = 'pending';
            if ($itemRequest->save()) {
                notify()->success('Request successfully added');
                return back();
            }

        } catch (\Exception $e) {
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }

    public function seller_request()
    {
        $request_list = DB::table('item_requests')
            ->select('item_requests.id as id', 'item_requests.date as date', 'request_categories.name as category', 'users.name as name', 'item_requests.contact_no as contact_no', 'item_requests.request as request', 'locations.code as location', 'item_requests.fee as fee', 'item_requests.status as status')
            ->leftJoin('users', 'item_requests.seller_id', '=', 'users.id')
            ->leftJoin('request_categories', 'item_requests.category', '=', 'request_categories.id')
            ->leftJoin('locations', 'item_requests.location_id', '=', 'locations.id')
            ->orderBy('id', 'ASC')
            ->get();
        $category = requestCategory::orderby('id', 'asc')->get();

        $sellers = User::whereHas(
            'roles', function($q){
            $q->where('name', 'seller');
        }
        )->get();

        $location = Location::orderby('id', 'asc')->get();
        return view('seller_request',
            [
                'categories' => $category,
                'request_lists' => $request_list,
                'sellers' => $sellers,
                'location' => $location
            ]
        );
    }

    public function update_request(Request $request)
    {
        //TODO update reuqest
    }
}
