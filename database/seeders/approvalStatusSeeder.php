<?php

namespace Database\Seeders;

use App\Models\approval_status;
use Illuminate\Database\Seeder;

class approvalStatusSeeder extends Seeder
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
            ['status'=>'Pending']
        ];

        approval_status::insert($data);
    }
}
