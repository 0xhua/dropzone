<?php

namespace App\Exports;

use App\Models\da_info;
use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;

class ItemExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         $items = Item::query();
        $items = $items
            ->select(
                'items.code',
                'items.date as drop_date',
                'buyer.name as buyer',
                'seller.name as seller',
                'o.area as origin',
                'd.area as destination',
                'items.fee', 'items.amount',
                'paid_statuses.status as payment_status',
                'item_statuses.status as status',
                'approval_statuses.status as approval_status',
                'items.claimed_date',
                'items.release_date',
                'c.area as current_location'
            )
            ->leftJoin('approval_statuses', 'items.approval_status_id', '=', 'approval_statuses.id')
            ->leftJoin('paid_statuses', 'items.payment_status_id', '=', 'paid_statuses.id')
            ->leftJoin('item_statuses', 'items.status_id', '=', 'item_statuses.id')
            ->leftJoin('locations as o', 'items.origin_id', '=', 'o.id')
            ->leftJoin('locations as d', 'd.id', '=', 'items.destination_id')
            ->leftJoin('locations as c', 'c.id', '=', 'items.current_location_id')
            ->leftJoin('users as buyer', 'items.buyer_id', '=', 'buyer.id')
            ->leftJoin('users as seller', 'items.seller_id', '=', 'seller.id');
        if (auth()->user()->hasRole('Admin')) {
            $items = $items->get();
        } elseif (auth()->user()->hasRole('da')) {
            $da_loc = da_info::where('da_id', Auth::id())->firstOrFail()->location_id;
            $items = $items->where('current_location_id', '=', $da_loc)
                ->orWhereNull('current_location_id')
                ->Where('destination_id', '=', $da_loc)->get();
        } else {
            $items = $items->where('items.seller_id', '=', auth()->id())->get();
        }

        return $items;
    }

    public function headings(): array
    {
        return ["your", "headings", "here"];
    }
}
