<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel chats yang dibuat di file pertama tadi
            $table->uuid('chat_id')->index(); 
            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade');
            $table->string('role');
            $table->text('message');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
