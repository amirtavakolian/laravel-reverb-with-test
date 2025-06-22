<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PrivateChatSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public function __construct(public array $message)
    {

    }


    public function broadcastOn()
    {
        return new PrivateChannel("private-chat.{$this->message['receiver_id']}");
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message['message'],
            'sender_id' => $this->message['sender_id'],
            'receiver_id' => $this->message['receiver_id'],
            'sender_firstname' => $this->message['sender_firstname'],
            'receiver_firstname' => $this->message['receiver_firstname']
        ];
    }
}



/*



*/


