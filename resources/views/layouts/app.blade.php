<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Fondation Hassan II') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font-awsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/pelerinage.css') }}">

    <style>
        /* 64ac15 */
        /*
                        *,
                        *:before,
                        *:after {
                        box-sizing: border-box;
                        } */

        body {

            font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 15px;
            color: #b9b9b9;
            background-color: #e9eff3;
        }

        h4 {
            color: #414755;
        }

        input,
        input[type="radio"]+label,
        input[type="checkbox"]+label:before,
        select option,
        select {
            width: 100%;
            padding: 1em;
            line-height: 1.4;
            background-color: #f9f9f9;
            border: 1px solid #e5e5e5;
            border-radius: 3px;
            -webkit-transition: 0.35s ease-in-out;
            -moz-transition: 0.35s ease-in-out;
            -o-transition: 0.35s ease-in-out;
            transition: 0.35s ease-in-out;
            transition: all 0.35s ease-in-out;
        }

        input:focus {
            outline: 0;
            border-color: #258876;
        }

        input:focus+.input-icon i {
            color: #36bea6;
        }

        input:focus+.input-icon:after {
            border-right-color: #36bea6;
        }

        /*  258876 */
        input[type="radio"] {
            display: none;
        }

        input[type="radio"]+label,
        select {
            display: inline-block;
            width: 50%;
            text-align: center;
            float: left;
            border-radius: 0;
        }

        input[type="radio"]+label:first-of-type {
            border-top-left-radius: 3px;
            border-bottom-left-radius: 3px;
        }

        input[type="radio"]+label:last-of-type {
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
        }

        input[type="radio"]+label i {
            padding-right: 0.4em;
        }

        input[type="radio"]:checked+label,
        input:checked+label:before,
        select:focus,
        select:active {
            background-color: #36bea6;
            color: #fff;
            border-color: #258876;
        }

        input[type="checkbox"] {
            display: none;
        }

        input[type="checkbox"]+label {
            position: relative;
            display: block;
            padding-left: 1.6em;
        }

        input[type="checkbox"]+label:before {
            position: absolute;
            top: 0.2em;
            left: 0;
            display: block;
            width: 1em;
            height: 1em;
            padding: 0;
            content: "";
        }

        input[type="checkbox"]+label:after {
            position: absolute;
            top: 0.45em;
            left: 0.2em;
            font-size: 0.8em;
            color: #fff;
            opacity: 0;
            font-family: FontAwesome;
            content: "\f00c";
        }

        input:checked+label:after {
            opacity: 1;
        }

        select {
            height: 3.4em;
            line-height: 2;
        }

        select:first-of-type {
            border-top-left-radius: 3px;
            border-bottom-left-radius: 3px;
        }

        select:last-of-type {
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
        }

        select:focus,
        select:active {
            outline: 0;
        }

        select option {
            background-color: #36bea6;
            color: #fff;
        }

        .input-group {
            margin-bottom: 1em;
            zoom: 1;
        }

        .input-group:before,
        .input-group:after {
            content: "";
            display: table;
        }

        .input-group:after {
            clear: both;
        }

        .input-group-icon {
            position: relative;
        }

        .input-group-icon input {
            padding-left: 4.4em;
        }

        .input-group-icon .input-icon {
            position: absolute;
            top: 0;
            left: 0;
            width: 3.4em;
            height: 3.4em;
            line-height: 3.4em;
            text-align: center;
            pointer-events: none;
        }

        .input-group-icon .input-icon:after {
            position: absolute;
            top: 0.6em;
            bottom: 0.6em;
            left: 3.4em;
            display: block;
            border-right: 1px solid #e5e5e5;
            content: "";
            -webkit-transition: 0.35s ease-in-out;
            -moz-transition: 0.35s ease-in-out;
            -o-transition: 0.35s ease-in-out;
            transition: 0.35s ease-in-out;
            transition: all 0.35s ease-in-out;
        }

        .input-group-icon .input-icon i {
            -webkit-transition: 0.35s ease-in-out;
            -moz-transition: 0.35s ease-in-out;
            -o-transition: 0.35s ease-in-out;
            transition: 0.35s ease-in-out;
            transition: all 0.35s ease-in-out;
        }

        .container-form {
            max-width: 38em;
            padding: 1em 3em 2em 3em;
            margin: 2em auto;
            background-color: #fff;
            border-radius: 4.2px;
            /* box-shadow: 0px 3px 10px -2px rgba(0, 0, 0, 0.2); */
        }

        .row {
            zoom: 1;
        }

        .row:before,
        .row:after {
            content: "";
            display: table;
        }

        .row:after {
            clear: both;
        }

        .col-half {
            padding-right: 10px;
            float: left;
            width: 50%;
        }

        .col-half:last-of-type {
            padding-right: 0;
        }

        .col-third {
            padding-right: 10px;
            float: left;
            width: 33.33333333%;
        }

        .col-third:last-of-type {
            padding-right: 0;
        }

        @media only screen and (max-width: 540px) {
            .col-half {
                width: 100%;
                padding-right: 0;
            }

        }

        .btn-action {
            background-color: #00a884;
            color: #fff;
            transition: 0.35s ease-in-out;
            transition: all 0.35s ease-in-out;

        }

        .btn-flash {
            background-color: transparent !important;

        }

        .btn-action:hover {
            background-color: #36bea6;
            color: #fff;
        }

        a.btn-link {
            text-decoration: none;
            color: #128ae0;
            transition: 0.35s ease-in-out;
            transition: all 0.35s ease-in-out;
            
        }

        a.btn-link:hover {
            text-decoration: underline;
            color: #4650dd;
        }

        .alert {
            margin: 10px auto;
            padding: 1em;
            color: #1f4f56;
        }

        .navbar-expand {
            background: rgb(0, 168, 132);
            background: linear-gradient(90deg, rgb(0, 168, 132) 0%, rgb(23, 162, 184) 100%);

        }

        li.nav-item a {
            color: #fff;
        }

        li.nav-item a:hover {
            color: #e5e5e5;
        }

        .navbar-brand {
            color: #fff;
            font-weight: 700;
        }

        .navbar-brand:hover {
            color: #e5e5e5;
        }

        .text-guide {
            color: #414755;
            margin-top: 20px;
        }
    </style>

    @livewireStyles
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand  shadow-sm px-2">

            <a class="navbar-brand bg-light rounded border border-secondary" href="{{ url('/') }}">
                <img src="{{ asset('images/Fondation-hassan-II-LOGO-01-300x73.png') }}" alt="">
            </a>
            {{-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Fondation Hassan II') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> --}}

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-dark" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>

        </nav>
        <main class="">
            @include('layouts.flash-message')
            @yield('content')
        </main>
    </div>
    @if (Session::has('success'))
        <script type="text/javascript">
            swal.fire({
                title: 'Success!',
                text: "{{ Session::get('success') }}",
                timer: 5000,
                type: 'success'
            }).then((value) => {
                //location.reload();
            }).catch(swal.noop);
        </script>
    @endif
    <script src="{{ asset('js/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @livewireScripts
</body>

</html>
