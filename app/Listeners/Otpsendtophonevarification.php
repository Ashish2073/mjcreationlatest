<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\sendphonevarificationotp;

use Illuminate\Support\Carbon;
use App\Models\User;

class Otpsendtophonevarification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(sendphonevarificationotp $event): void
    {
        $user=$event->userdata; 
        $userotp=$event->userotp;



       User::where('id',$user->id)->update([
        'otp'=> $userotp,
        'otp_created_at'=>Carbon::now(),
       ]);
    }
}
