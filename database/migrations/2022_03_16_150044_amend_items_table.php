<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AmendItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('origin');
            $table->dropColumn('destination');
            $table->dropColumn('status');
            $table->dropColumn('payment_status');
            $table->dropColumn('approval_status');
            $table->bigInteger('origin_id')->after('buyer_id');
            $table->bigInteger('destination_id')->after('origin_id');
            $table->bigInteger('status_id')->after('release_date');
            $table->bigInteger('payment_status_id')->after('status_id');
            $table->bigInteger('approval_status_id')->after('payment_status_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->text('origin')->after('buyer_id');
            $table->text('destination')->after('origin');
            $table->tinyText('status')->after('release_date');
            $table->tinyText('payment_status')->after('status');
            $table->tinyText('approval_status')->after('payment_status');
            $table->dropColumn('origin_id');
            $table->dropColumn('destination_id');
            $table->dropColumn('status_id');
            $table->dropColumn('payment_status_id');
            $table->dropColumn('approval_status_id');
        });
    }
}
