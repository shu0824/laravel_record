<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="icon" href="{{ asset('img/record.jpeg') }}">
    <script src="https://kit.fontawesome.com/d2664eb908.js" crossorigin="anonymous"></script>
    <title>フォローユーザー</title>
</head>
<body  class="xl:w-1/2 lg:w-1/2 md:w-1/2 w-full  m-auto mt-16  bg-gray-100 list-none">
    <div>
        <a href="{{ route('user.index') }}">
        <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><i class="fa-solid fa-arrow-left"></i></button></a>
    </div>

    <ul class="max-w-xs flex flex-col divide-y divide-gray-200 dark:divide-gray-700">
        @foreach($followUsers as $followUser)
        <form action="{{ route('record.index') }}" method='post'>
            @csrf
            <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-medium text-gray-800 dark:text-white">
                <input name="id" type="hidden" value="{{ $followUser->for }}">
                <input name="name" type="hidden" value="{{ $followUser->name }}">
                <input name="before" type="hidden" value="follow">
                <button type="submit">
                    {{ $followUser->name }}
                </button>
            </li>
        </form>
        @endforeach
    </ul>
</body>
