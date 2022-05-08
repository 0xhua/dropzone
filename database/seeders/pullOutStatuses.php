<?php

namespace Database\Seeders;

use App\Models\pullOutStatus;
use Illuminate\Database\Seeder;

class pullOutStatuses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['status'=>'For Pull-Out'],
            ['status'=>'In-Transit'],
            ['status'=>'Received'],
            ['status'=>'Pulled Out'],
        ];
        pullOutStatus::insert($data);
    }
}
