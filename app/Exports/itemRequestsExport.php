<?php

namespace App\Exports;

use App\Models\da_info;
use App\Models\itemRequest;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class itemRequestsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $request_list = itemRequest::
        select(
            'item_requests.id as id',
            'item_requests.date as date',
            'request_categories.name as category',
            'users.name as name',
            'item_requests.contact_no as contact_no',
            'item_requests.request as request',
            'locations.code as location',
            'item_requeststatuses.status as status'
        )
            ->leftJoin('users', 'item_requests.seller_id', '=', 'users.id')
            ->leftJoin('request_categories', 'item_requests.category', '=', 'request_categories.id')
            ->leftJoin('locations', 'item_requests.location_id', '=', 'locations.id')
            ->leftJoin('item_requeststatuses', 'item_requests.status_id','item_requeststatuses.id')
            ->orderBy('id', 'ASC');
        if (auth()->user()->hasRole('Admin')) {
            $request_list = $request_list->get();
        } elseif (auth()->user()->hasRole('da')) {
            $da_loc = da_info::where('da_id', Auth::id())->firstOrFail()->location_id;
            $request_list = $request_list->where('users.location_id', '=', $da_loc)->get();
        } else {
            $request_list = $request_list->where('item_requests.seller_id', '=', auth()->id())->get();
        }

        return $request_list;
    }

    public function headings(): array
    {
        return ["Code", "ID","Date","Name","Phone Number","Request","Location","Status"];
    }
}
