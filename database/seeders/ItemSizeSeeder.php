<?php

namespace Database\Seeders;

use App\Models\item_size;
use Illuminate\Database\Seeder;

class ItemSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['size'=>'XS-Small'],
            ['status'=>'Medium'],
            ['status'=>'Large'],
            ['status'=>'XL-XXL']
        ];

        echo item_size::insert($data);
    }
}
