<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('da_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('da_id')->unsigned();
            $table->index('da_id');
            $table->foreign('da_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('location_id')->unsigned();
            $table->index('location_id');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('da_infos');
    }
}
