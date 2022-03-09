<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->date('date');
            $table->bigInteger('seller_id');
            $table->bigInteger('buyer_id');
            $table->text('origin');
            $table->text('destination');
            $table->bigInteger('fee');
            $table->bigInteger('amount');
            $table->dateTime('claimed_date');
            $table->dateTime('release_date');
            $table->tinytext('status');
            $table->tinytext('payment_status');
            $table->tinytext('approval_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
