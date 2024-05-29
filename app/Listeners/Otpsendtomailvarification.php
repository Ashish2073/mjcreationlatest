<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\Sendemailvarificationotp;

use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Vendor;

class Otpsendtomailvarification
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
    public function handle(Sendemailvarificationotp $event): void
    {
        $user = $event->userdata;
        $userotp = $event->userotp;



        // User::where('id', $user->id)->update([
        //     'otp' => $userotp,
        //     'otp_created_at' => Carbon::now(),
        // ]);
        if ($user instanceof User) {
            // Update the User table
            User::where('id', $user->id)->update([
                'otp' => $userotp,
                'otp_created_at' => Carbon::now(),
            ]);
        } elseif ($user instanceof Vendor) {
            // Update the Vendor table
            Vendor::where('id', $user->id)->update([
                'otp' => $userotp,
                'otp_created_at' => Carbon::now(),
            ]);
        }
    }
}
