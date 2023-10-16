<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Custom styles-path -->
    <link rel="stylesheet" href="{{ url('css/login.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link type="text/css" rel="stylesheet" href="{{url('css/notiflix-3.2.6.min.css')}}">
    <!-- Font Awesome kit script -->
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

    <!-- Google Fonts Open Sans-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ url('images/loginhtml-5.png') }}">
</head>

<body>
    @yield('content')
    <script src="{{url('js/jquery-3.7.0.min.js')}}"></script>
    <script src="{{url('js/notiflix-3.2.6.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/login.js') }}"></script>
</body>

</html>
