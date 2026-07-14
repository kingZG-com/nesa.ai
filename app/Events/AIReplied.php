<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow; // 🔥 Wajib pakai ini biar instan
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AIReplied implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chatId;
    public $message;

    // Data yang mau lo lempar ke front-end masukin sini
    public function __construct($chatId, $message)
    {
        $this->chatId = $chatId;
        $this->message = $message;
    }

    // Tentukan nama "pipa" tempat data ini bakal disemburkan
    public function broadcastOn(): array
    {
        // Pipa dinamis sesuai ID Chat yang lagi aktif
        return [
            new Channel('chat.' . $this->chatId),
        ];
    }

    // Opsional: Bikin nama event yang ditangkep JS lebih rapi
    public function broadcastAs(): string
    {
        return 'AIReplied';
    }
}
