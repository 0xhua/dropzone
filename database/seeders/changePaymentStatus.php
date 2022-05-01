<?php

namespace Database\Seeders;

use App\Models\paid_status;
use Illuminate\Database\Seeder;

class changePaymentStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $change = paid_status::findOrFail(2);
        $change->status = "Unpaid";
        $change->save();
    }
}
