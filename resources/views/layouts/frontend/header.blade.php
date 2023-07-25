<!DOCTYPE html>
<html lang="zxx">

<head>

    <!-- ** Basic Page Needs ** -->
    <meta charset="utf-8">
    <title>{{ $title }} | SimVice</title>

    <!-- ** Mobile Specific Metas ** -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="SimVice website multi konter">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Farsiah Irmawati">
    <meta name="generator" content=" Mix Developers">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <!-- theme meta -->
    <meta name="theme-name" content="medic" />

    <!-- ** Plugins Needed for the Project ** -->
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('frontend_theme/') }}/plugins/bootstrap/bootstrap.min.css">
    <!-- Slick Carousel -->
    <link rel="stylesheet" href="{{ asset('frontend_theme/') }}/plugins/slick/slick.css">
    <link rel="stylesheet" href="{{ asset('frontend_theme/') }}/plugins/slick/slick-theme.css">
    <!-- FancyBox -->
    <link rel="stylesheet" href="{{ asset('frontend_theme/') }}/plugins/fancybox/jquery.fancybox.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ asset('frontend_theme/') }}/plugins/fontawesome/css/all.min.css">
    <!-- animate.css -->
    <link rel="stylesheet" href="{{ asset('frontend_theme/') }}/plugins/animation/animate.min.css">
    <!-- jquery-ui -->
    <link rel="stylesheet" href="{{ asset('frontend_theme/') }}/plugins/jquery-ui/jquery-ui.css">
    <!-- timePicker -->
    <link rel="stylesheet" href="{{ asset('frontend_theme/') }}/plugins/timePicker/timePicker.css">

    <!-- Stylesheets -->
    <link href="{{ asset('frontend_theme/') }}/css/style.css" rel="stylesheet">


    <!--Favicon-->
    <link rel="icon" href="{{ asset('/img/icon.png') }}" type="image/x-icon">
    @yield('css')
</head>


<body>
    <div class="page-wrapper">
