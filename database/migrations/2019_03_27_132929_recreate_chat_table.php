<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecreateChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('chat_room_user', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('chat_room_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('chat_messages', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('sender_id')->nullable();
            $table->unsignedInteger('chat_room_id')->nullable();

            $table->text('message');

            $table->boolean('is_read')->default(false);

            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_rooms');
        Schema::dropIfExists('chat_room_user');
        Schema::dropIfExists('chat_messages');
    }
}
