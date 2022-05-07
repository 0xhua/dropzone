<?php

namespace Database\Seeders;

use App\Models\item_status;
use Illuminate\Database\Seeder;

class addCashOutDoneStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['status'=>'C/O Done'],
        ];
        item_status::insert($data);
    }
}
