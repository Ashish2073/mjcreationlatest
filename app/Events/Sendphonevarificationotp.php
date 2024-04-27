<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use Twilio\Rest\Client;

class Sendphonevarificationotp
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $userdata;
    public $userotp;
    public function __construct($otp,$data)
    {

       
        $this->userdata=$data;
        $this->userotp=$otp;

        

        $message="your otp is"." ".$this->userotp;
        $phoneNumber="+91".$this->userdata->phone_no;


        $twiliosid=getenv('TWILIO_ACCOUNT_SID');

        

        $twiliotoken=getenv('TWILIO_AUTH_TOKEN');

        $twiliophonenumber=getenv('TWILIO_PHONE_NUMBER');

      $client= new Client( $twiliosid,$twiliotoken);

      $client->messages->create($phoneNumber,[
        'from'=> $twiliophonenumber,
        'body'=>$message,

      ]);






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
