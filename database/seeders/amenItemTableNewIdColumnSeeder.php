<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class amenItemTableNewIdColumnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->update(['origin_id' => 1, 'destination_id' => 2, 'status_id' => 1, 'payment_status_id' => 1, 'approval_status_id' => 1]);

    }
}
