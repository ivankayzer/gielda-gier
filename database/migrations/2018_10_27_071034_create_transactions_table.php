<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('seller_id')->nullable()->unsigned();
            $table->integer('buyer_id')->nullable()->unsigned();
            $table->integer('status_id');

            $table->json('seller_value');
            $table->json('buyer_value')->nullable();

            $table->boolean('buyer_comment')->default(false);
            $table->boolean('seller_comment')->default(false);

            $table->integer('price')->nullable()->default(0);

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
