<?php

namespace Database\Seeders;

use App\Models\da_info;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;

class daseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total = Location::query()->count();
        $da = User::factory($total)->create();
        foreach ($da as $key => $user){
            $da_info = new da_info();
            $da_info->da_id = $user->id;
            $da_info->location_id = $key+1;
            $da_info->save();
            $user->assignRole([4]);
        }
    }
}
