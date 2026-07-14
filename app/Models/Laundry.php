<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasFactory;

    // Definisikan nama tabel kalau misal beda dari pluralnya (opsional, tapi good practice)
    protected $table = 'laundries';

    // Daftarin semua kolom yang boleh diisi secara massal lewat seeder atau form
    protected $fillable = [
        'name',
        'image_url', // 👈 Ini kolom baru yang barusan kita bahas
        'location',
        'whatsapp',
        'open_hours',
        'open_on_holidays',
        'capacity_status',
        'price_regular_kg',
        'duration_regular_days',
        'has_express',
        'price_express_kg',
        'duration_express_hours',
        'price_suit_almet',
        'duration_suit_almet_hours',
        'price_white_shirt',
        'price_shoes',
        'price_iron_only',
        'accept_kebaya_dress',
        'has_delivery',
        'min_delivery_kg',
        'accept_qris'
    ];

    // Opsional: Kalau kamu mau otomatis konversi tipe data boolean
    protected $casts = [
        'open_on_holidays' => 'boolean',
        'has_express' => 'boolean',
        'accept_kebaya_dress' => 'boolean',
        'has_delivery' => 'boolean',
        'accept_qris' => 'boolean',
    ];
}
