<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="icon" href="{{ asset('img/record.jpeg') }}">
    <script src="https://kit.fontawesome.com/d2664eb908.js" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
</head>
<body  class="xl:w-4/5 lg:w-4/5 w-full  m-auto  bg-gray-100 list-none">
    @yield('content')
</body>
