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
        Schema::create('laundries', function (Blueprint $table) {
            $table->id();

            // Info Dasar
            $table->string('name');
            $table->text('location');
            $table->string('whatsapp')->nullable();
            $table->string('maps_link')->nullable();

            // Waktu Operasional
            $table->string('open_hours')->nullable(); // contoh: "07.00 - 00.00"
            $table->boolean('open_on_holidays')->default(false);
            $table->string('capacity_status')->default('Normal'); // Normal, Penuh, dll

            // Paket Reguler
            $table->integer('price_regular_kg')->nullable();
            $table->integer('duration_regular_days')->nullable();

            // Paket Express
            $table->boolean('has_express')->default(false);
            $table->integer('price_express_kg')->nullable();
            $table->integer('duration_express_hours')->nullable(); // dalam satuan jam

            // Satuan Spesifik (Senjata utama buat target market mahasiswa)
            $table->integer('price_suit_almet')->nullable();
            $table->integer('duration_suit_almet_hours')->nullable();
            $table->integer('price_white_shirt')->nullable();
            $table->integer('price_shoes')->nullable();
            $table->integer('price_iron_only')->nullable();
            $table->boolean('accept_kebaya_dress')->default(false);

            // Fitur Pelayanan Tambahan
            $table->boolean('has_delivery')->default(false);
            $table->integer('min_delivery_kg')->nullable();
            $table->boolean('accept_qris')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundries');
    }
};
