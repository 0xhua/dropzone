<?php

namespace Database\Seeders;

use App\Models\announcement;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;

class deleteBasuraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

           announcement::truncate();
    }
}
