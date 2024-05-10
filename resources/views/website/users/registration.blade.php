@extends('website.layout.main')
@section('title', 'User Registertion')
@section('content')
    <style>
        @keyframes loader-element {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .loader-element div {
            position: absolute;
            width: 120px;
            height: 120px;
            border: 20px solid #125e81;
            border-top-color: transparent;
            border-radius: 50%;
        }

        .loader-element div {
            animation: loader-element 1s linear infinite;
            top: 100px;
            left: 100px;
        }

        .demo {
            -webkit-filter: blur(5px) grayscale(100%);
            pointer-events: none;
        }

        .loader-element {
            transform: translateZ(0) scale(1);
            backface-visibility: hidden;
            transform-origin: 0 0;

            z-index: 999999 !important;
            position: absolute;
            top: 25vh;
            left: 43vw;
        }


        * {
            box-sizing: border-box;
        }

        .title {
            max-width: 400px;
            margin: auto;
            text-align: center;
            font-family: "Poppins", sans-serif;

            h3 {
                font-weight: bold;
            }

            p {
                font-size: 12px;
                color: #118a44;

                &.msg {
                    color: initial;
                    text-align: initial;
                    font-weight: bold;
                }
            }
        }

        .otp-input-fields {
            margin: auto;
            background-color: white;
            box-shadow: 0px 0px 8px 0px #02025044;
            max-width: 400px;
            width: auto;
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 40px;

            input {
                height: 40px;
                width: 40px;
                background-color: transparent;
                border-radius: 4px;
                border: 1px solid #2f8f1f;
                text-align: center;
                outline: none;
                font-size: 16px;

                &::-webkit-outer-spin-button,
                &::-webkit-inner-spin-button {
                    -webkit-appearance: none;
                    margin: 0;
                }

                /* Firefox */
                &[type=number] {
                    -moz-appearance: textfield;
                }

                &:focus {
                    border-width: 2px;
                    border-color: darken(#2f8f1f, 5%);
                    font-size: 20px;
                }
            }
        }

        .result {
            max-width: 400px;
            margin: auto;
            padding: 24px;
            text-align: center;

            p {
                font-size: 24px;
                font-family: 'Antonio', sans-serif;
                opacity: 1;
                transition: color 0.5s ease;

                &._ok {
                    color: green;
                }

                &._notok {
                    color: red;
                    border-radius: 3px;
                }
            }

        }

        @import url('https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap');

        button:focus,
        input:focus {
            outline: none;
            box-shadow: none;
        }

        a,
        a:hover {
            text-decoration: none;
        }

        body {
            font-family: 'Roboto', sans-serif;
        }

        /*------------------  */
        .otp-countdown {
            display: inline-block;
            margin: 0 auto;
            padding: 8px 30px;
            background-color: #333;
            border-radius: 50px;
            color: #fff;

        }
    </style>



    <div class="container-div">
        <div class="loader-element" id="loader">

        </div>
    </div>



    <section id="main_content">

        <div class="container my-5 ">
            <div class="row">
                <div class="col-lg-4 left-box">
                    <h2 class="mt-4">Login/Sign up</h2>
                    <h6>Get access to your Orders, <br />Wishlist and Recommendations</h6>
                    <image src="{{ asset('img/user.png') }}" class="img-fluid user-img mt-4"></image>
                </div>
                <div class="col-lg-8 right-box">
                    <form action="{{ route('users-registration') }}" method="POST" id="user-registration-form">
                        @csrf
                        <div class="form-group">
                            <label for="user_contact"><b>Enter Your Mobile No./ Email</b></label>
                            <input type="text" id="user_contact" name ="user_contact" class="form-control"
                                aria-describedby="user_contact" placeholder="Enter Your Mobile No./ Email"
                                autocomplete="off" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('phone_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>




                        <!-- form -->
                        {{-- <div class="form-group">
                            <label for="login-mobile" class="font-weight-bold text-dark">Mobile</label>
                            <div class="input-group input-group-sm">
                                <input id="mobile" type="tel" name="mobile" class="form-control" autofocus required
                                    style="width:500px;">
                            </div>
                        </div> --}}










                        <br />
                        <div class="form-group">
                            <label for="userpassword"><b>Enter Your Password</b></label>
                            <input type="password" name="password" class="form-control" id="userpassword"
                                placeholder="Enter Your Password" autocomplete="off" />

                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <br />
                        <p class="text-center">
                            By continuing, you agree to Flipkart's Terms of Use and Privacy
                            Policy.
                        </p>

                        @if (Request::segment(2) == 'login')
                            <div class="s-box">

                                <div>
                                    <button type="submit" class="btn sbt-btn" id="loginbutton">
                                        Login
                                    </button>

                                </div>
                            </div>
                        @else
                            <div class="s-box">

                                <div>
                                    <button type="submit" class="btn sbt-btn" id="otpsubmitbutton">
                                        Request to OTP
                                    </button>
                                    <p class="text-center"><b>Not received your code?</b></p>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>

@section('page-script')
    <script>
        $(document).ready(function() {

            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': false,
                'progressBar': false,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'showDuration': '1000',
                'hideDuration': '1000',
                'timeOut': '5000',
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut',
            }




            function otpFieldScript() {
                var otp_inputs = document.querySelectorAll(".otp__digit")
                var mykey = "0123456789".split("")
                otp_inputs.forEach((_) => {
                    _.addEventListener("keyup", handle_next_input)
                })

                function handle_next_input(event) {
                    let current = event.target
                    let index = parseInt(current.classList[1].split("__")[2])
                    current.value = event.key

                    if (event.keyCode == 8 && index > 1) {
                        current.previousElementSibling.focus()
                    }
                    if (index < 6 && mykey.indexOf("" + event.key + "") != -1) {
                        var next = current.nextElementSibling;
                        next.focus()
                    }
                    var _finalKey = ""
                    for (let {
                            value
                        }
                        of otp_inputs) {
                        _finalKey += value
                    }
                    if (_finalKey.length == 6) {
                        document.querySelector("#_otp").classList.replace("_notok", "_ok")
                        document.querySelector("#_otp").innerText = _finalKey
                    } else {
                        document.querySelector("#_otp").classList.replace("_ok", "_notok")
                        document.querySelector("#_otp").innerText = _finalKey
                    }
                }
            }


            function otpLifeTime() {

                if ($('#timer-countdown').length) {
                    function countdown(elementName, minutes, seconds) {
                        var element, endTime, hours, mins, msLeft, time;

                        function twoDigits(n) {
                            return (n <= 9 ? "0" + n : n);
                        }

                        function updateTimer() {
                            msLeft = endTime - (+new Date);
                            if (msLeft < 1000) {
                                element.innerHTML = "Time is up!";
                                $("#otp_verify").html('Resend Otp')
                                $("#timer").val(0);

                            } else {
                                $("#otp_verify").html(' Verify Otp')
                                $("#timer").val(2);
                                time = new Date(msLeft);
                                hours = time.getUTCHours();
                                mins = time.getUTCMinutes();
                                element.innerHTML = (hours ? hours + ':' + twoDigits(mins) : mins) + ':' +
                                    twoDigits(time.getUTCSeconds());
                                setTimeout(updateTimer, time.getUTCMilliseconds() + 500);
                            }
                        }
                        element = document.getElementById(elementName);
                        endTime = (+new Date) + 1000 * (60 * minutes + seconds) + 500;
                        updateTimer();
                    }
                    countdown("timer-countdown", 2, 0);
                }

            }

            function otpvarification() {

                console.log($("#timer").val());
                $('#otp_verify').on('click', function(e) {

                    e.preventDefault();

                    if ($("#timer").val() != 0) {
                        let otp1 = $('#otp1').val();
                        let otp2 = $('#otp2').val();
                        let otp3 = $('#otp3').val();
                        let otp4 = $('#otp4').val();
                        let otp5 = $('#otp5').val();
                        let otp6 = $('#otp6').val();
                        let user_id = $('#user_id').val();
                        let user_contact = $("#user_contact").val();

                        $.ajax({
                            url: "{{ route('user-otpverification') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                otp1: otp1,
                                otp2: otp2,
                                otp3: otp3,
                                otp4: otp4,
                                otp5: otp5,
                                otp6: otp6,
                                user_id: user_id,
                                user_contact: user_contact
                            },
                            beforeSend: function() {

                                $('#loader').html('<div></div>');

                                $('#main_content').attr('class',
                                    'demo');

                            },
                            success: (data) => {
                                console.log(data);
                                $('#loader').html('');
                                $('#main_content').removeAttr('class',
                                    'demo');
                                $("#timer-countdown").html("You allready varified user");
                                $('#otp1').val(" ");
                                $('#otp2').val(" ");
                                $('#otp3').val(" ");
                                $('#otp4').val(" ");
                                $('#otp5').val(" ");
                                $('#otp6').val(" ");






                                window.location.href = "{{ url('users/home') }}";



                            },
                            error: (xhr, status, error) => {

                                if (xhr.status == 422) {


                                    toastr.error(
                                        xhr.responseJSON.msg
                                    );
                                    $('#loader').html('');
                                    $('#main_content').removeAttr('class', 'demo');
                                    // $("#timer").val(2);
                                    // otpFieldScript();
                                    // otpLifeTime();
                                    // otpvarification();

                                }

                            }

                        })

                    } else {
                        otpResend();
                    }


                })




            }

            function otpResend() {

                let user_id = $("#user_id").val();
                let user_contact = $("#user_contact").val();
                $.ajax({
                    url: "{{ route('user-otpresend') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_id: user_id,
                        user_contact: user_contact,

                    },
                    beforeSend: function() {

                        $('#loader').html('<div></div>');

                        $('#main_content').attr('class',
                            'demo');

                    },
                    success: (data) => {
                        console.log(data);
                        $('#loader').html('');
                        $('#main_content').removeAttr('class',
                            'demo');
                        $("#otp_verify").html('Verify Otp')

                        otpFieldScript();
                        otpLifeTime();






                    },
                    error: (error) => {

                    }

                })


            }





            $('#otpsubmitbutton').on('click', function(e) {
                e.preventDefault();

                let userContact = $('#user_contact').val();
                let password = $('#userpassword').val();

                $.ajax({
                    url: "{{ route('users-registration') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_contact: userContact,
                        password: password,
                    },
                    beforeSend: function() {

                        $('#loader').html('<div></div>');

                        $('#main_content').attr('class', 'demo');

                    },
                    success: (data) => {

                        $('#loader').html('');
                        $('#main_content').removeAttr('class', 'demo');

                        $('#main_content').html(data.responsehtml);
                        otpFieldScript();
                        otpLifeTime();
                        otpvarification();





                    },
                    error: (error) => {

                        if (error.responseJSON.errormessage.phone_no) {
                            toastr.error(error.responseJSON.errormessage.phone_no[0]);
                            $('#loader').html('');
                            $('#main_content').removeAttr('class', 'demo');

                        }


                        if (error.responseJSON.errormessage.email) {


                            toastr.error(error.responseJSON.errormessage.email[0]);
                            $('#loader').html('');
                            $('#main_content').removeAttr('class', 'demo');
                        }

                    }

                })

            })


            $('#loginbutton').on('click', function(e) {
                e.preventDefault();
                let userContact = $('#user_contact').val();
                let password = $('#userpassword').val();
                $.ajax({
                    url: "{{ route('users-auth-login') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_contact: userContact,
                        password: password,
                    },
                    beforeSend: function() {

                        $('#loader').html('<div></div>');

                        $('#main_content').attr('class', 'demo');

                    },
                    success: (data) => {
                        $('#loader').html('');
                        $('#main_content').removeAttr('class', 'demo');


                        window.location.href = "{{ url('users/home') }}";




                    },
                    error: (xhr, status, error) => {


                        if (xhr.status == 422) {


                            toastr.error(
                                "Your account is not verified ,otp is send to your registered contact details"
                            );
                            $('#loader').html('');
                            $('#main_content').removeAttr('class', 'demo');
                            $('#main_content').html(xhr.responseJSON.responsehtml);
                            otpFieldScript();
                            otpLifeTime();
                            otpvarification();

                        }
                        if (xhr.status == 401) {

                            $('#loader').html('');
                            $('#main_content').removeAttr('class', 'demo');
                            toastr.error("Your are not authorized person");
                        }


                    }

                })


            })



        });
    </script>

@endsection


@endsection
