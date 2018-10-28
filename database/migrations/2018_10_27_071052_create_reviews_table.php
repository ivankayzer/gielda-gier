<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('transaction_id')->unsigned();

            $table->enum('type', ['positive', 'negative', 'neutral']);

            $table->text('comment')->nullable();

            $table->integer('reviewee_id')->nullable()->unsigned();
            $table->integer('reviewer_id')->nullable()->unsigned();

            $table->timestamps();

            $table->foreign('reviewee_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('reviewer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
