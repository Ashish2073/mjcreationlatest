<section>
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-4 left-box">
                <h2 class="mt-4">Login/Sign up</h2>
                <h6>Get access to your Orders, <br />Wishlist and Recommendations</h6>
                <image src="{{ asset('img/user.png') }}" class="img-fluid user-img mt-4"></image>
            </div>
            <div class="col-lg-8 right-box">
                <form>


                    <br />
                    <p class="text-center info">
                        Please enter the OTP sent to
                    </p>
                    <p class="text-center">

                        {{ $user_contact }}

                        {{-- <span class="change">Change</span> --}}
                    </p>
                    <div>

                        <input type="hidden" name="user_id" id="user_id" value="{{ $user_id }}" />
                        <input type="hidden" name="user_contact" id="user_contact" value="{{ $user_contact }}" />
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
