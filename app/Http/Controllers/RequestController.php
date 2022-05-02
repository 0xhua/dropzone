<?php

namespace App\Http\Controllers;

use App\Helpers\SmsApiHelper;
use App\Models\da_info;
use App\Models\itemRequest;
use App\Models\Location;
use App\Models\requestCategory;
use App\Models\User;
use Carbon\Carbon;
use Humans\Semaphore\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                'contact_no' => ['required', 'regex:/(09)|(9)[0-9]{9}/'],
                'itemRequest' => 'required',
                'location' => 'required'
            ]);
            $itemRequest = new itemRequest();
            $itemRequest->date = Carbon::now();
            $itemRequest->category = $request->category;
            $itemRequest->seller_id = (auth()->user()->hasRole('seller'))?Auth::id():$request->seller_id;
            $itemRequest->contact_no = $request->contact_no;
            $itemRequest->request = $request->itemRequest;
            $itemRequest->location_id = Location::find($request->location)->id;
            $itemRequest->fee = 20;
            if ($itemRequest->save()) {
                if($request->wantsJson()){
                    return response()->json(['status' => 'success', 'message' => 'Request successfully added']);
                }
                notify()->success('Request successfully added');
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

    public function seller_request(Request $request)
    {

        $request_list = itemRequest::select('item_requests.id as id', 'item_requests.date as date', 'request_categories.name as category', 'users.name as name', 'item_requests.contact_no as contact_no', 'item_requests.request as request', 'locations.area as location', 'item_requests.fee as fee', 'item_requeststatuses.status as status', 'item_requests.status_id')
            ->leftJoin('users', 'item_requests.seller_id', '=', 'users.id')
            ->leftJoin('request_categories', 'item_requests.category', '=', 'request_categories.id')
            ->leftJoin('locations', 'item_requests.location_id', '=', 'locations.id')
            ->leftJoin('item_requeststatuses', 'item_requests.status_id','item_requeststatuses.id')
            ->orderBy('id', 'ASC');
        if (auth()->user()->hasRole('da')) {
            $da_loc = da_info::where('da_id', Auth::id())->firstOrFail()->location_id;
            $request_list = $request_list->where('users.location_id', '=', $da_loc);
        } elseif(auth()->user()->hasRole('seller')) {
            $request_list = $request_list->where('item_requests.seller_id', '=', auth()->id());
        }
        $category = requestCategory::orderby('id', 'asc')->get();

        $sellers = User::whereHas(
            'roles', function ($q) {
            $q->where('name', 'seller');
        }
        )->get();

        $location = Location::orderby('id', 'asc')->get();
        $request_list = $request_list->paginate(20);
        if($request->wantsJson()){
            return response()->json(
                [
                    'categories' => $category,
                    'request_lists' => $request_list,
                    'sellers' => $sellers,
                    'location' => $location
                ], 200);
        }
        return view('itemrequest',
            [
                'categories' => $category,
                'request_lists' => $request_list,
                'sellers' => $sellers,
                'location' => $location
            ]
        )->with('i', ($request->input('page', 1) - 1) * 5);;
    }
//request update = category, request
    public function update_request(Request $request)
    {
        //TODO update reuqest

        try {
            $itemRequest = itemRequest::findOrFail($request->id);
            $itemRequest->request = $request->input('request',$itemRequest->request);
            $itemRequest->category = $request->input('category',$itemRequest->category);
            $itemRequest->contact_no = $request->input('contact_no', $itemRequest->contact_no);

            if ($itemRequest->save()) {
                notify()->success('Request successfully updated');
                return back();
//                return response()->json(['status' => 'success', 'message' => 'Request details updated successfully']);
            }

        } catch (\Exception $e) {
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
//            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function updateRequestStatus(Request $request){
        try {
            $this->validate($request, [
                'id' => 'required',
                'status' => 'required',
            ]);

            $itemRequest = itemRequest::findOrFail($request->id);
            $seller = User::findOrFail($itemRequest->seller_id);
            switch ($request->status) {
                case 1:
                    $sms_message = 'Your request has been approved by the DA'.PHP_EOL;
                    $sms_message .= 'Request ID:'.$itemRequest->id;
                    $itemRequest->status_id = 1;
                    $message = 'Request successfully approved';
                    break;
                case 2:
                    $sms_message = 'Your request has been rejected by the DA'.PHP_EOL;
                    $sms_message .= 'Request ID:'.$itemRequest->id;
                    $itemRequest->status_id = 2;
                    $message = 'Request rejected';
                    break;
                case 3:
                    $itemRequest->status_id = 3;
                    $message = 'Request successfully processed';
                    break;
                case 4:
                    $itemRequest->status_id = 4;
                    $message = 'Request marked as done';
                    break;
            }
            if ($itemRequest->save()) {
                if(!empty($sms_message)){
                    app(SmsApiHelper::class)->send_sms($seller->phone_number,$sms_message);
                }
                notify()->success($message);
                return back();
            }
        }catch (\Exception $e){
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }
}
