<?php

namespace Database\Seeders;

use App\Models\cashout_status;
use Illuminate\Database\Seeder;

class cashoutStatusSeeder extends Seeder
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
            ['status'=>'Released'],
            ['status'=>'Rejected']
        ];

        cashout_status::insert($data);
    }
}
