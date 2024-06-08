<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use app\smsvarification;
use App\Events\Sendemailvarificationotp;
use Illuminate\Auth\Events\Lockout;

class LoginController extends Controller
{
    public function vendorlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        $vendor = Auth::guard('vendor')->getProvider()->retrieveByCredentials($credentials);



        if (($vendor && $vendor->is_verified == 1 && $vendor->status == 1) || !$vendor) {
            if (Auth::guard('vendor')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('vendors/productlist');
            } else {
                return redirect()->back()->withErrors([
                    'message' => 'Invalid Credentials.'
                ]);

            }
        } elseif ($vendor && $vendor->status == 0) {
            return redirect()->back()->withErrors([
                'message' => 'You are not active user ,your account is deactive.'
            ]);

        } elseif ($vendor && $vendor->is_verified == 0) {

            if (isset($request->email)) {
                $otp = rand(100000, 999999);

                $vendorData = $vendor;



                event(new Sendemailvarificationotp($otp, $vendorData));



            }



            return redirect()->route('vendors.otpvarifiaction')->withErrors([
                'message' => 'Please verify your account first. An OTP has been sent to your email.',
            ]);
        }




    }

    protected function incrementLoginAttempts(Request $request)
    {
        $key = $this->throttleKey($request);
        $maxAttempts = 5;
        $decayMinutes = 10;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        RateLimiter::hit($key, $decayMinutes * 60);
    }

    protected function throttleKey(Request $request)
    {
        return strtolower($request->input('email')) . '|' . $request->ip();
    }


    protected function fireLockoutEvent(Request $request)
    {
        event(new Lockout($request));
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => [trans('auth.throttle', ['seconds' => $seconds])],
        ])->status(429);
    }
}
