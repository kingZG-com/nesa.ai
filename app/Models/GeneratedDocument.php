<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratedDocument extends Model
{
    use HasFactory;

    /**
     * Biar gampang insert data (Mass Assignment).
     * Semua kolom boleh diisi otomatis lewat create() atau insert().
     */
    protected $guarded = [];

    /**
     * Relasi ke tabel users.
     * Satu dokumen pasti dimiliki oleh satu user (guru).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}