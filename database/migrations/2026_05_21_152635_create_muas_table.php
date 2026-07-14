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
        Schema::create('muas', function (Blueprint $table) {
            $table->id();

            // Info Utama MUA
            $table->string('name');
            $table->string('social_link')->nullable(); // @wongjowokebaya
            $table->text('location'); // Lamper Tengah
            $table->string('whatsapp')->nullable(); // +62 858-6576-6668
            $table->string('specialty')->nullable(); // Tradisional Jawa, Bold

            // Fitur / Include (Pake Boolean biar AI lo gampang nge-filter)
            $table->boolean('include_hair_hijab')->default(false);
            $table->boolean('rent_accessories')->default(false);
            $table->boolean('home_service')->default(false);
            $table->boolean('accept_qris')->default(true);

            // Kapasitas & Durasi Kerja
            $table->decimal('duration_hours', 3, 1)->nullable(); // Bisa nampung 1.5 atau 2.5 jam
            $table->integer('daily_capacity')->nullable(); // 2 Orang

            // Paket Utama (Pake Integer biar bisa di-sort harga termurah)
            $table->integer('price_sidang')->nullable();
            $table->integer('price_wisuda')->nullable();
            $table->integer('price_party')->nullable();
            $table->integer('home_service_fee')->default(0);

            // Paket Add-ons / Eceran
            $table->integer('price_hairdo')->nullable();
            $table->integer('price_hijabdo')->nullable();
            $table->integer('price_softlens_nails')->nullable();
            $table->integer('price_accessories_rent')->nullable();
            $table->integer('price_companion')->nullable();

            // Aturan Operasional
            $table->string('booking_rules')->nullable(); // "H-14"
            $table->string('dp_terms')->nullable(); // "50%" (pake string karena bisa persen atau nominal)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muas');
    }
};
