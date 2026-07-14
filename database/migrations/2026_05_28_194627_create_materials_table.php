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
    Schema::create('materials', function (Blueprint $table) {
        $table->id();
        $table->foreignId('module_id')->constrained()->onDelete('cascade'); // Relasi ke tabel modules
        $table->string('title');
        $table->string('slug'); // Untuk URL yang rapi
        $table->longText('content'); // Isi detail materinya (bisa pakai tag HTML nanti)
        $table->integer('order'); // Urutan materi (1, 2, 3, dst)
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
