<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id')->unsigned();
            $table->integer('game_id')->unsigned();
            $table->string('platform');
            $table->string('language');
            $table->integer('price')->nullable();
            $table->text('comment');

            $table->boolean('sellable')->default(true);
            $table->boolean('tradeable')->default(true);

            $table->boolean('payment_bank_transfer')->default(true);
            $table->boolean('payment_cash')->default(true);

            $table->boolean('delivery_post')->default(true);
            $table->boolean('delivery_in_person')->default(true);

            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
