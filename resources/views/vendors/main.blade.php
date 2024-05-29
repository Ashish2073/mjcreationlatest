<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('fontawesome/font-awesome.min.css') }}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" type="text/css" media="screen" />




    <link rel="stylesheet" href="{{ asset('css/fontgoogleapis.css') }}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('fontawesome/font-awesome.w3.css') }}" type="text/css" media="screen" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/maps/style.css.map') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/adminstyle.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/font-awesome.w3.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendorcss/ti-icons/css/themify-icons.css') }}">

    <link rel='stylesheet' type="text/css" href="{{ asset('css/owl.carousel.min.css') }}">

    <link rel='stylesheet' href="{{ asset('css/owl.them.default.css') }}">






    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/boostrap.min.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/boostrap5.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/button.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/toaster.min.css') }}">




    {{-- <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="{{ asset('js/jquery.js') }}"></script>

    <script src="{{ asset('js/toaster.min.js') }}"></script>







    <title>@yield('title')</title>
</head>

<body class="">














    @yield('content')







    <script src="{{ asset('vendor/livewire/livewire.js') }}"></script>
    @yield('page-script')



</body>

</html>
