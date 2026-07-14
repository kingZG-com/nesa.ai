<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'level', 
        'badge_color', 
        'icon', 
        'icon_color', 
        'title', 
        'subtitle', 
        'image', 
    ];


    public function materials()
{
    return $this->hasMany(Material::class)->orderBy('order');
}
}