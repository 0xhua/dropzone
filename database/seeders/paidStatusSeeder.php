<?php

namespace Database\Seeders;

use App\Models\paid_status;
use Illuminate\Database\Seeder;

class paidStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['status'=>'Paid'],
            ['status'=>'UnPaid'],
        ];
        paid_status::insert($data);
    }
}
