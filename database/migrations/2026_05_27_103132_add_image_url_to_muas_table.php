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
        Schema::table('muas', function (Blueprint $table) {
            $table->string('image_url')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('muas', function (Blueprint $table) {
            // Harus ditambahkan agar kolom terhapus saat di-rollback
            $table->dropColumn('image_url');
        });
    }
};
