<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\Otpsendformetmail;
use Illuminate\Queue\SerializesModels;

class Sendemailvarificationotp
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $userdata;
    public $userotp;

    public function __construct($otp, $data)
    {
        $this->userdata = $data;
        $this->userotp = $otp;



        Mail::to($this->userdata->email)->send(new Otpsendformetmail($this->userotp));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
