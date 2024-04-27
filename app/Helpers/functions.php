<?php

if(!function_exists('mergerequestoremailorphone_no')) {
    function mergerequestoremailorphone_no($request)
    {
        $emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $phoneNumberPattern='/^[6-9]\d{9}$/';


        if(preg_match($emailPattern,$request->user_contact)){
            $request->merge(['email' => $request->user_contact]);
        }

        if(preg_match($phoneNumberPattern,$request->user_contact)){
            $request->merge(['phone_no' => $request->user_contact]);
        }
    }
}


?>