<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>InCharge API - Admin Login</title>
        <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/incharge.css') }}">
        <link rel="stylesheet" href="{{ asset('fonts/material-icons.css') }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles -->
        <style>
            body {
                height: 100vh;
            }
            h1 {
                font-size: 3.2rem;
                margin: 0;
            }
            h2 {
                font-size: 2rem;
                margin: 2vh 0;
                font-weight: 100;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <adminlogin-component></adminlogin-component>
        </div>

        <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('js/materialize.min.js') }}"></script>
        <script src="{{ asset('js/incharge.js') }}"></script>  
        <script src="{{ asset('js/app.js') }}"></script>        
        
    </body>
</html>
