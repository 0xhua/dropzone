<?php

namespace Database\Seeders;

use App\Models\itemRequeststatus;
use Illuminate\Database\Seeder;

class itemRequestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['status'=>'Approved'],
            ['status'=>'Rejected'],
            ['status'=>'Processed'],
            ['status'=>'Done']
        ];

        itemRequeststatus::insert($data);
    }
}
