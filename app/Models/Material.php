<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['module_id', 'title', 'slug', 'content', 'order'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
