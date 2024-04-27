<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\Sendemailvarificationotp;
use App\Events\Sendphonevarificationotp;
use Twilio\Rest\Client;
use App\Models\User;
use app\smsvarification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{

    public function register(Request $request){
      

        mergerequestoremailorphone_no($request);



        $validator = Validator::make($request->all(), [
            'phone_no' => 'sometimes|required|string|max:255|unique:users,phone_no',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'user_contact'=>'required', 

        ]);



        
        if ($validator->fails()) {
            return response()->json([
                'sucess'=>true,
                'errormessage'=>$validator->errors(),
            ],422);
        }

    

        $userData=User::create([

            'email' => $request->email??Null,
            'phone_no'=>$request->phone_no ?? NULL,
            'password' => Hash::make($request->password),
        ]);


        if(isset($request->email)){
            $otp = rand(100000,999999);

           
        
            event(new Sendemailvarificationotp($otp,$userData));



        }

        if(isset($request->phone_no)){

            $otp = rand(100000,999999);

           
        
            event(new Sendphonevarificationotp($otp,$userData));

        }




        $responsehtml=view::make('website.users.otpvarification',['user_contact'=>$request->user_contact,'user_id'=>$userData->id])->render();
      

        return response()->json([
            'sucess'=>true,
            'responsehtml'=>$responsehtml
        ],200);

    }



    public function verificationview(){

        return view('users.otpvarification');

    }


    public function verifiedOtp(Request $request)
    {

        mergerequestoremailorphone_no($request);

        $otp1 = $request->input('otp1');
        $otp2 = $request->input('otp2');
        $otp3 = $request->input('otp3');
        $otp4 = $request->input('otp4');
        $otp5 = $request->input('otp5');
        $otp6 = $request->input('otp6');

        $combinedOTP = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;
        $otpNumber = (int)$combinedOTP;


        $userOtp= User::where('otp',$otpNumber)->where('id',$request->user_id)->first();

        if(!$userOtp){
            return response()->json(['success' => false,'msg'=> 'You entered wrong OTP'],422);
        }
        else{


            $currentTime = Carbon::now();
            $otpCreatedAt = Carbon::parse($userOtp->created_at);
            $differenceInSeconds = $currentTime->diffInSeconds($otpCreatedAt);

            if($currentTime->greaterThanOrEqualTo($otpCreatedAt) && $differenceInSeconds<=120){

                    if($request->email){
                         User::where('id',$userOtp->id)->update([
                          'is_verified' => '1',
                           'email_verified_at'=> Carbon::now()
                      ]);
               }elseif($request->phone_no){
                User::where('id',$userOtp->id)->update([
                    'is_verified' => '1',
                    'phone_verified_at'=> Carbon::now()
                ]);

              }

              Auth::login($userOtp);

                return response()->json(['success' => true,'msg'=> 'Mail has been verified'],200);
            }
            else{
                return response()->json(['success' => false,'msg'=> 'Your OTP has been Expired'],422);
            }

        }
    }


    public function otpresend(Request $request){

        $emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $phoneNumberPattern='/^[6-9]\d{9}$/';


        if(preg_match($emailPattern,$request->user_contact)){
            $request->merge(['email' => $request->user_contact]);
        }

        if(preg_match($phoneNumberPattern,$request->user_contact)){
            $request->merge(['phone_no' => $request->user_contact]);
        }

        $userData=User::where('id',$request->user_id)->first();

        if(isset($request->email)){
            $otp = rand(100000,999999);
            event(new Sendemailvarificationotp($otp,$userData));



        }

        if(isset($request->phone_no)){
            $otp = rand(100000,999999);
            event(new Sendphonevarificationotp($otp,$userData));

        }

        return response()->json([
            'sucess'=>true,
            'message'=>"Otp resend Sucessfully"
        ],200);

    }














}

