<?php

namespace Database\Seeders;

use App\Models\requestCategory;
use Illuminate\Database\Seeder;

class request_catergory_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Pick-Up'],
            ['name'=> 'Delivery'],
            ['Pull-Out']
        ];
        requestCategory::insert($data);
    }
}
