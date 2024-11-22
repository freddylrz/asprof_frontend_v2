<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentStatus implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $room_id;
    private $data;

    public function __construct($room_id, $data)
    {
        $this->room_id = $room_id;
        $this->data    = $data;

        \Log::info($this->data);
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
            new Channel('paymentStatus-channel.' . $this->room_id),
        ];
    }

    public function broadcastAs()
    {
        return 'payment.status';
    }
}
