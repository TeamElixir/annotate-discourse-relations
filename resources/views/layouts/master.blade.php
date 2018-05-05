<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | TeamElixir .</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script>window.Laravel = { csrfToken: '{{csrf_token()}}'}</script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
</head>
<body>
@include('layouts.navbar')
<div class="container">
    @yield('content')
</div>


<script src="{{asset('js/app.js')}}" crossorigin="anonymous"></script>
</body>
</html>