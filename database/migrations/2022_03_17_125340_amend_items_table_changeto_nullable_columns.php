<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AmendItemsTableChangetoNullableColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dateTime('claimed_date')->nullable()->change();
            $table->dateTime('release_date')->nullable()->change();
            $table->bigInteger('status_id')->nullable()->change();
            $table->bigInteger('payment_status_id')->nullable()->change();
            $table->bigInteger('approval_status_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
