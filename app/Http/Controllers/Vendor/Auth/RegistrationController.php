<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use app\smsvarification;
use App\Events\Sendemailvarificationotp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:vendors,email',
            'password' => 'required|string|min:8|confirmed',
            // 'password_confirmation' => 'required|string|same:password',


        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }





        $vendorData = Vendor::create([

            'name' => $request->name,
            'email' => $request->email ?? Null,
            'password' => Hash::make($request->password),
        ]);




        if (isset($request->email)) {
            $otp = rand(100000, 999999);



            event(new Sendemailvarificationotp($otp, $vendorData));



        }


        return redirect()->route('vendors.otpvarification')->with('registrationsuccess', 'otp send to your mail sucessfullly!')
            ->with('vendoremail', $vendorData->email)
            ->with('vendorid', $vendorData->id);
        ;









    }

    public function otpvarification()
    {

        return view('vendors.otpvarifiaction');

    }


    public function otpmatch(Request $request)
    {

        $otp1 = $request->input('otp1');
        $otp2 = $request->input('otp2');
        $otp3 = $request->input('otp3');
        $otp4 = $request->input('otp4');
        $otp5 = $request->input('otp5');
        $otp6 = $request->input('otp6');

        $combinedOTP = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;
        $otpNumber = (int) $combinedOTP;


        $userOtp = Vendor::where('otp', $otpNumber)->where('id', $request->id)->first();

        if (!$userOtp) {
            return response()->json(['success' => false, 'msg' => 'You entered wrong OTP'], 422);
        } else {


            $currentTime = Carbon::now();
            $otpCreatedAt = Carbon::parse($userOtp->created_at);
            $differenceInSeconds = $currentTime->diffInSeconds($otpCreatedAt);

            if ($currentTime->greaterThanOrEqualTo($otpCreatedAt) && $differenceInSeconds <= 120) {

                if ($request->email) {
                    Vendor::where('id', $userOtp->id)->update([
                        'is_verified' => '1',
                        'email_verified_at' => Carbon::now()
                    ]);
                }


                Auth::guard('vendor')->login($userOtp);

                return;
            } else {
                return response()->json(['success' => false, 'msg' => 'Your OTP has been Expired'], 422);
            }

        }


    }


    public function vendorlogout(Request $request)
    {

        Auth::guard('vendor')->logout();

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('vendors');


    }
}
