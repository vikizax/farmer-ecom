<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link href="{{ asset('admin/css/toolkit-inverse.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/application.css ') }}" rel="stylesheet">


    <script src="{{ asset('admin/js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/tether.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/chart.js') }}" defer></script>
    <script src="{{ asset('admin/js/tablesorter.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/toolkit.js') }}" defer></script>
    <script src="{{ asset('admin/js/application.js') }}" defer></script>

</head>

<body>
    <main>
        @include('flash-message')
        @yield('content')
    </main>
</body>

</html>
