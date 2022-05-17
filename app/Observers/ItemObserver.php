<?php

namespace App\Observers;

use App\Models\Item;
use App\Models\User;
use App\Notifications\newDroppedItem;
use App\Notifications\NewUserNotification;
use Notification;

class ItemObserver
{
    /**
     * Handle the Item "created" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function created(Item $item)
    {
        $admins = User::whereHas('roles', function ($query) {
            $query->whereName('da');
        })->where('location_id',$item->origin_id)->get();
        $items = Item::query();
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
                'items.df',
                'items.current_location_id',
                'items.pull_out_status_id'
            )
            ->leftJoin('approval_statuses', 'items.approval_status_id', '=', 'approval_statuses.id')
            ->leftJoin('paid_statuses', 'items.payment_status_id', '=', 'paid_statuses.id')
            ->leftJoin('item_statuses', 'items.status_id', '=', 'item_statuses.id')
            ->leftJoin('locations as o', 'items.origin_id', '=', 'o.id')
            ->leftJoin('locations as d', 'd.id', '=', 'items.destination_id')
            ->leftJoin('locations as c', 'c.id', '=', 'items.current_location_id')
            ->leftJoin('users as buyer', 'items.buyer_id', '=', 'buyer.id')
            ->leftJoin('users as seller', 'items.seller_id', '=', 'seller.id')
            ->where('items.id', $item->id)
            ->first();
        Notification::send($admins, new newDroppedItem($items));
    }

    /**
     * Handle the Item "updated" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function updated(Item $item)
    {
        //
    }

    /**
     * Handle the Item "deleted" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function deleted(Item $item)
    {
        //
    }

    /**
     * Handle the Item "restored" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function restored(Item $item)
    {
        //
    }

    /**
     * Handle the Item "force deleted" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function forceDeleted(Item $item)
    {
        //
    }
}
