<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>InCharge API - Admin Panel</title>
        <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/incharge.css') }}">
        <link rel="stylesheet" href="{{ asset('fonts/material-icons.css') }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles -->
        
    </head>
    <body>
        <div id="app">
            <admin-component></admin-component>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>    
        <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('js/materialize.min.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN_xNkP9PnYMSLth9l9rfzoqUtFEvUAwA&libraries=&v=weekly" async></script>
        <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key="></script> callback=initMap&-->
        <script src="{{ asset('js/incharge.js') }}"></script>  
            
        
    </body>
</html>
