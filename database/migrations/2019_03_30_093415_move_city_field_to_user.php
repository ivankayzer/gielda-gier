<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveCityFieldToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('city_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('city_id')->nullable()->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->integer('city_id')->nullable()->unsigned();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('city_id');
        });
    }
}
