<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageCount implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function broadcastWith(): array
    {
        return [
            'data' => $this->data
        ];
    }

    public function broadcastOn()
    {
        return [
            new Channel('medikolegalCount-channel.' . $this->room_id),
        ];
    }

    public function broadcastAs()
    {
        return 'message.count';
    }
}
