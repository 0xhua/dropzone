<?php

namespace Database\Seeders;

use App\Models\item_status;
use Illuminate\Database\Seeder;

class itemStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['status'=>'Claimed'],
            ['status'=>'In-Transit'],
            ['status'=>'Pull-Out'],
            ['status'=>'Ready'],
            ['status'=>'Transfered'],
            ['status'=>'Released']
        ];
        item_status::insert($data);
    }
}
