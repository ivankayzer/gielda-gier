<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->integer('igdb_id')->unique()->change();
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->integer('platform')->change();
            $table->integer('game_id')->change();
            $table->foreign('game_id')->references('igdb_id')->on('games')->onDelete('cascade');
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->unsignedInteger('receiver_id')->nullable()->change();
            $table->unsignedInteger('created_by')->nullable()->change();

            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->string('type')->nullable();
            $table->unsignedInteger('user_id')->nullable()->change();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
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
