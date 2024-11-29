<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestStatus implements ShouldBroadcastNow
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
            'reqId'      => $this->data['reqId'],
            'statusId'   => $this->data['statusId'],
            'statusDesc' => $this->data['statusDesc']
        ];
    }

    public function broadcastOn()
    {
        return [
            new Channel('requestStatus-channel.' . $this->data['reqId']),
        ];
    }

    public function broadcastAs()
    {
        return 'request.status';
    }
}
