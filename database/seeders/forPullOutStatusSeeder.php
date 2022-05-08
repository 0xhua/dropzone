<?php

namespace Database\Seeders;

use App\Models\item_status;
use Illuminate\Database\Seeder;

class forPullOutStatusSeeder extends Seeder
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
        ];
        item_status::insert($data);
    }
}
