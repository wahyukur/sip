<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPosyandu Mandiri') }}</title>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{!! asset('bower_components/bootstrap/dist/css/bootstrap.min.css') !!}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! asset('bower_components/font-awesome/css/font-awesome.min.css') !!}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{!! asset('bower_components/Ionicons/css/ionicons.min.css') !!}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! asset('dist/css/AdminLTE.min.css') !!}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{!! asset('plugins/iCheck/square/blue.css') !!}">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    @yield('css')
</head>
<body class="hold-transition login-page">

    @yield('content')

    <!-- jQuery 3 -->
    <script src="{!! asset('bower_components/jquery/dist/jquery.min.js') !!}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{!! asset('bower_components/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
    <!-- iCheck -->
    <script src="{!! asset('plugins/iCheck/icheck.min.js') !!}"></script>
    
    @yield('java')
</body>
</html>