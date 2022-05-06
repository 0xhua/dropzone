<?php

namespace App\Exports;

use App\Models\da_info;
use App\Models\User;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DASellersRequestsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $da_loc = Auth::user();
        $users =  User::select('users.id',
            'users.name',
            'users.email',
            'users.phone_number', 'locations.area', 'user_statuses.status')
            ->leftJoin('locations', 'locations.id', '=', 'users.location_id')
            ->leftJoin('user_statuses', 'user_statuses.id', '=', 'users.status_id');

        if(auth()->user()->hasRole('da')) $users = $users->where('locations.id', $da_loc->location_id);
        $users = $users->whereHas(
            'roles', function ($q) {
            $q->where('name', 'seller');
        })->get();
        return $users;
    }

    public function headings(): array
    {
        return ["ID", "Name", "Email", "Phone Number","Location","Status"];
    }
}
