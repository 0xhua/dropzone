<?php

namespace Database\Seeders;

use App\Models\transactionFee;
use Illuminate\Database\Seeder;

class transactionFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'type' => 'base_fee',
                'size_id' => null,
                'amount' => 10
            ],
            [
                'type' => 'weight_base_fee',
                'size_id' => null,
                'amount' => 10
            ],
            [
                //XS-SMALL FEE
                'type' => 'size_fee',
                'size_id' => 1,
                'amount' => 10
            ],
            [
                //Medium FEE
                'type' => 'size_fee',
                'size_id' => 2,
                'amount' => 20
            ],
            [   //Large FEE
                'type' => 'size_fee',
                'size_id' => 3,
                'amount' => 30
            ],
            [
                //XL-XXL FEE
                'type' => 'size_fee',
                'size_id' => 4,
                'amount' => 40
            ]
        ];
        transactionFee::insert($data);
    }
}
