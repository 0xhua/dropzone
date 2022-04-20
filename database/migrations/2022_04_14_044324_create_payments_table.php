<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->bigInteger('item_id')->unsigned();
            $table->index('item_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->bigInteger('seller_id')->unsigned();
            $table->index('seller_id');
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('cashout_id')->nullable()->unsigned();
            $table->index('cashout_id');
            $table->foreign('cashout_id')->references('id')->on('cashout_requests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
