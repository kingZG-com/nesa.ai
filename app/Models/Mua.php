<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mua extends Model
{
    use HasFactory;

    protected $table = 'muas';

    // Buka gerbang buat Mass Assignment
    protected $fillable = [
        'name',
        'image_url', 
        'social_link',
        'location',
        'whatsapp',
        'specialty',
        'include_hair_hijab',
        'rent_accessories',
        'home_service',
        'accept_qris',
        'duration_hours',
        'daily_capacity',
        'price_sidang',
        'price_wisuda',
        'price_party',
        'home_service_fee',
        'price_hairdo',
        'price_hijabdo',
        'price_softlens_nails',
        'price_accessories_rent',
        'price_companion',
        'booking_rules',
        'dp_terms'
    ];

    // Konversi tipe data otomatis biar performa filter AI makin ngebut
    protected $casts = [
        'include_hair_hijab' => 'boolean',
        'rent_accessories' => 'boolean',
        'home_service' => 'boolean',
        'accept_qris' => 'boolean',
    ];
}
