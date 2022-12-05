<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>{{isset($title)?$title:"Asset Management Systems"}}
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'Asset Management Systems'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>
    
    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre') 
    @if(\Auth::check())
    <link rel="stylesheet" href="{{ asset('css/bo_style.css') }}">   
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
    @else 
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
    @endif
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}"> 
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote.css') }}">
    <style type="text/css">
        #toast-container.toast-bottom-center>div, #toast-container.toast-top-center>div {
            width: 500px;
            margin-left: auto;
            margin-right: auto;
        } 
    </style>
    {{-- Base Stylesheets --}}
    @if (!config('adminlte.enabled_laravel_mix'))
        <link rel="stylesheet" href="{{ asset('plugin_vendor/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugin_vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

        {{-- Configured Stylesheets --}}
        @include('adminlte::plugins', ['type' => 'css'])

        <link rel="stylesheet" href="{{ asset('plugin_vendor/adminlte/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @else
        <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    {{-- Livewire Styles --}}
    @if (config('adminlte.livewire'))
        @if (app()->version() >= 7)
            @livewireStyles
        @else
            <livewire:styles />
        @endif
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')

    {{-- Favicon --}}
    @if (config('adminlte.use_ico_only'))
        <link rel="shortcut icon" href="{{ asset('icon/asset.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">
        <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    @endif 
</head>

<body class="@yield('classes_body')" @yield('body_data')>
    {{-- Body Content --}}
    @php
    (new \Lib\Menu())->getTreeMenu();
    @endphp
    @yield('body')
    @section('plugins.Select2', true) 
    @section('plugins.Sweetalert2', true) 
    {{-- Base Scripts --}}
    @if (!config('adminlte.enabled_laravel_mix'))
        <script type="text/javascript" src="{{ asset('plugin_vendor/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugin_vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugin_vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        
        {{-- Configured Scripts --}}
        @include('adminlte::plugins', ['type' => 'js'])

        <script type="text/javascript" src="{{ asset('plugin_vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @else
        <script type="text/javascript" src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif

    {{-- Livewire Script --}}
    @if (config('adminlte.livewire'))
        @if (app()->version() >= 7)
            @livewireScripts
        @else
            <livewire:scripts />
        @endif
    @endif
    @auth
    <script type="text/javascript" src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/jquery-validation/localization/messages_id.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/summernote/summernote.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.form.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/mujahidin.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('plugins/toastr/toastr.min.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('js/ui-notific8.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('js/ui-toastr.min.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('js/message.js') }}"></script> 
  
    @endauth
    {{-- Custom Scripts --}}
    @yield('adminlte_js')

</body>

</html>
