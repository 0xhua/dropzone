<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Faker\Generator as Faker;

class buyersellerseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sellers = \App\Models\User::factory(10)->create();
        foreach ($sellers as $user){
            $user->assignRole([2]);
        }

        $buyers = \App\Models\User::factory(10)->create();
        foreach ($buyers as $user){
            $user->assignRole([3]);
        }
    }
}
