<?php

namespace Database\Seeders;

use App\Models\paid_status;
use Illuminate\Database\Seeder;

class addGcashPaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['status' => 'Paid via Gcash'],
        ];
        paid_status::insert($data);
    }
}
