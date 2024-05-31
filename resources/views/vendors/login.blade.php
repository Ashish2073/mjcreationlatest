@extends('vendors.main')

@section('title', 'Register Page')

{{-- Page CSS files --}}
<link rel="stylesheet" href="{{ asset('css/authentication.css') }}">

@section('content')
    <section class="row flexbox-container mt-6">
        <div class="col-xl-12 col-10 d-flex  justify-content-center">
            <div class="card bg-authentication">
                <div class="row m-0">
                    <div class="col-lg-6 d-lg-block  text-center align-self-center pl-0 pr-3 py-0">
                        <img src="{{ asset('img/register.jpg') }}" alt="branding logo">
                    </div>
                    <div class="col-lg-6 col-12 p-0">
                        <div class="card rounded-0 mb-0 p-2">
                            <div class="card-header pt-50 pb-1">
                                <div class="card-title">
                                    <img class="mb-1 img-fluid" src="" alt="" />

                                    <h4 class="mb-0">Please Login</h4>
                                </div>
                            </div>
                            <p class="px-2 pb-2">Fill the below for login.</p>
                            <div class="card-content">
                                <div class="card-body pt-0">

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif



                                    <form method="POST" action="{{ route('vendors.login') }}">
                                        @csrf

                                        <div class="form-label-group">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                placeholder="Email" value="{{ old('email') }}" autocomplete="email">

                                        </div>
                                        <div class="form-label-group">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                placeholder="Password" autocomplete="new-password">

                                        </div>

                                        <div class="form-group">
                                            <label>By clicking Register, you agree to our <a target="_blank"
                                                    href="">Terms</a> and <a target="_blank" href="">Privacy
                                                    Policy</a>.</label>
                                        </div>
                                        <a href="{{ route('vendors.registration') }}"
                                            class="btn btn-outline-primary float-left btn-inline mb-50">Registration</a>
                                        <button type="submit" class="btn btn-primary float-right btn-inline mb-50">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
