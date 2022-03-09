<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class locationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['area'=>'Agoo'],
            ['area'=>'Aringay'],
            ['area'=>'Bacnotan'],
            ['area'=>'Bagulin'],
            ['area'=>'Balaoan'],
            ['area'=>'Bangar'],
            ['area'=>'Bauang'],
            ['area'=>'Burgos'],
            ['area'=>'Caba'],
            ['area'=>'Damortis'],
            ['area'=>'Luna'],
            ['area'=>'Naguilian'],
            ['area'=>'Pugo'],
            ['area'=>'Rosario'],
            ['area'=>'San Fernando'],
            ['area'=>'San Gabriel'],
            ['area'=>'San Juan'],
            ['area'=>'Santol'],
            ['area'=>'Sto. Tomas'],
            ['area'=>'Sudipen'],
            ['area'=>'Tubao']
        ];
        Location::insert($data);
    }
}
