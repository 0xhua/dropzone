<?php

namespace Database\Seeders;

use App\Models\item_status;
use Illuminate\Database\Seeder;

class changeStatusId3ItemStatuses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = item_status::findOrFail(3);
        $status->status = 'Pulled-Out';
        $status->save();
    }
}
