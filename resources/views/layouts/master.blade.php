<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://gitcdn.link/cdn/0xhua/font-awesome-6-pro/main/css/all.min.css" rel="stylesheet">

    @yield('js')
    <link rel="stylesheet" href="{{asset('css/sidenav.css')}}">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/tablelist.css')}}">
    <link rel="stylesheet" href="{{asset('css/tooltip.css')}}">
    @yield('css')
    @notifyCss
    <style type="text/css"> .notify{ z-index: 1000000; margin-top: 5%; } </style>
</head>
<body id="body-pd" class>
    @include('notify::components.notify')
    <x:notify-messages />
    @notifyJs
    @include('popper::assets')
    @include('partials.topnav')
    @include('partials.sidenav')
    @yield('content')
    @include('partials.js')
</body>
    @yield('javascript')
<html>
