<?php

namespace App\Events;

use App\Models\Chat as ModelsChat;
use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Chat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int $chatId,
        public string $message
        ) 
    {
       
    }

    public function broadcastOn(): array {
        // $this->message is available here
        // return [
        //     new Channel("chat_on"),
        // ];
        



        return [
            new Channel("chats." . $this->chatId),
        ];
    }
}