<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    
    // Kolom yang diizinkan untuk diisi secara massal
    protected $fillable = ['chat_id', 'role', 'message'];

    /**
     * Relasi: Balon chat ini merujuk/kembali ke Sesi Chat utamanya
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }
}
