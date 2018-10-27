<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id')->unsigned();
            $table->integer('buyer_id')->unsigned();
            $table->integer('status_id');

            $table->enum('type', ['transaction', 'offer']);

            $table->json('seller_value');
            $table->json('buyer_id');

            $table->text('seller_comment');
            $table->text('buyer_comment');

            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
