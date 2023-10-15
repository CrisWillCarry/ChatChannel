<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('message');
            $table->timestamps();
            $table->integer('senderId')->unsigned();
            $table->foreign('senderId')
                    ->references('id')
                    ->on('chat_users')
                    ->onCascade('delete');
            $table->integer('receiverId')->unsigned();
            $table->foreign('receiverId')
                    ->references('id')
                    ->on('chat_users')
                    ->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
