@extends('vendors.main')

@section('title', 'otp varification')
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
<section>
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-4 left-box">

                <h6>Please Enter your otp</h6>
                <image src="{{ asset('img/user.png') }}" class="img-fluid user-img mt-4"></image>
            </div>
            <div class="col-lg-8 right-box">
                <form>


                    <br />
                    <p class="text-center info">
                        Please enter the OTP sent to
                    </p>
                    <p class="text-center">

                        @if (session('vendoremail'))
                            <p>Your email: {{ session('vendoremail') }}</p>
                            <input type="hidden" id="user_contact" value="{{ session('vendoremail') }}" />
                        @endif

                        @if (session('registrationsuccess'))
                            <div class="alert alert-success" id="success-message">
                                {{ session('registrationsuccess') }}
                            </div>
                        @endif

                        @if (session('vendorid'))
                            <input type="hidden" id="user_id" value="{{ session('vendorid') }}" />
                        @endif

                        {{-- <span class="change">Change</span> --}}
                    </p>
                    <div>


                        <input type="hidden" name="time" id="timer" value="" />
                        {{-- <div class="container text-center mb-3 mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><a href="#" target="_blank">2 Minute</a></h4>
                                </div>
                            </div>
                        </div> --}}
                        <div class="container mb-3 mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <div class="otp-countdown" id="timer-countdown">02:00</div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="otp-input-fields">
                            <input type="number" id="otp1" name="otp1" class="otp__digit otp__field__1">
                            <input type="number" id="otp2" name="otp2" class="otp__digit otp__field__2">
                            <input type="number" id="otp3" name="otp3" class="otp__digit otp__field__3">
                            <input type="number" id="otp4" name="otp4" class="otp__digit otp__field__4">
                            <input type="number" id="otp5" name="otp5" class="otp__digit otp__field__5">
                            <input type="number" id="otp6" name="otp6" class="otp__digit otp__field__6">
                        </div>
                    </div>
                    <div class="s-box">
                        <div>
                            <button type="submit" class="btn sbt-btn mt-3" id="otp_verify">
                                Verify Otp
                            </button>







                            <p class="text-center"><b>Not received your code?</b></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@section('page-script')
    <script>
        $(document).ready(function() {

            console.log($('#user_id').val(), $("#user_contact").val());

            setTimeout(function() {
                $('#success-message').fadeOut('slow');
            }, 1500);


            otpFieldScript();
            otpLifeTime();
            otpvarification();


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


                $('#otp_verify').on('click', function(e) {

                    e.preventDefault();



                    if ($("#timer").val() != 0) {

                        console.log('asasas', $("#timer").val());

                        let otp1 = $('#otp1').val();
                        let otp2 = $('#otp2').val();
                        let otp3 = $('#otp3').val();
                        let otp4 = $('#otp4').val();
                        let otp5 = $('#otp5').val();
                        let otp6 = $('#otp6').val();
                        let id = $('#user_id').val();
                        let email = $("#user_contact").val();

                        $.ajax({
                            url: "{{ route('vendors.otpmatch') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                otp1: otp1,
                                otp2: otp2,
                                otp3: otp3,
                                otp4: otp4,
                                otp5: otp5,
                                otp6: otp6,
                                id: id,
                                email: email
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






                                window.location.href = "{{ url('vendors/productlist') }}";



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

                        });

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





            // $('#otpsubmitbutton').on('click', function(e) {
            //     e.preventDefault();

            //     let userContact = $('#user_contact').val();
            //     let password = $('#userpassword').val();

            //     $.ajax({
            //         url: "{{ route('users-registration') }}",
            //         type: "POST",
            //         data: {
            //             _token: "{{ csrf_token() }}",
            //             user_contact: userContact,
            //             password: password,
            //         },
            //         beforeSend: function() {

            //             $('#loader').html('<div></div>');

            //             $('#main_content').attr('class', 'demo');

            //         },
            //         success: (data) => {

            //             $('#loader').html('');
            //             $('#main_content').removeAttr('class', 'demo');

            //             $('#main_content').html(data.responsehtml);
            //             otpFieldScript();
            //             otpLifeTime();
            //             otpvarification();





            //         },
            //         error: (error) => {

            //             if (error.responseJSON.errormessage.phone_no) {
            //                 toastr.error(error.responseJSON.errormessage.phone_no[0]);
            //                 $('#loader').html('');
            //                 $('#main_content').removeAttr('class', 'demo');

            //             }


            //             if (error.responseJSON.errormessage.email) {


            //                 toastr.error(error.responseJSON.errormessage.email[0]);
            //                 $('#loader').html('');
            //                 $('#main_content').removeAttr('class', 'demo');
            //             }

            //         }

            //     })

            // })






        });
    </script>
@endsection
