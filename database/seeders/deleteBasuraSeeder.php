<?php

namespace Database\Seeders;

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
        for($i=2;$i<66;$i++){
            Item::where('seller_id',$i)->delete();
            User::findOrFail($i)->delete();
        }
    }
}
