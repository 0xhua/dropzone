<?php

namespace App\Exports;

use App\Models\da_info;
use App\Models\User;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class DASellersRequestsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $da_loc = User::where('id', Auth::id())->get();
        return User::select('users.*', 'locations.area', 'user_statuses.status')
            ->leftJoin('locations', 'locations.id', '=', 'users.location_id')
            ->leftJoin('user_statuses', 'user_statuses.id', '=', 'users.status_id')
            ->where('locations.id', $da_loc->location_id)
            ->whereHas(
                'roles', function ($q) {
                $q->where('name', 'seller');
            })
            ->get();
    }
}
