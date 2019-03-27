<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixTransactionsSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('seller_value');
            $table->dropColumn('buyer_value');

            $table->integer('buyer_game_id')->nullable();
            $table->integer('buyer_game_platform')->nullable();

            $table->foreign('buyer_game_id')->references('igdb_id')->on('games')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
