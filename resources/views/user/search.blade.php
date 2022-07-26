<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="icon" href="{{ asset('img/record.jpeg') }}">
    <script src="https://kit.fontawesome.com/d2664eb908.js" crossorigin="anonymous"></script>
    <title>ユーザー</title>
</head>
<body  class="xl:w-1/2 lg:w-1/2 md:w-1/2 w-full  m-auto mt-16  bg-gray-100 list-none">

    <div>
        <a href="{{ route('user.index') }}">
        <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><i class="fa-solid fa-arrow-left"></i></button></a>
    </div>

    <form action="{{ route('user.search') }}" method="post">
        @csrf
        <div class="max-w-xs">
            <div class="flex rounded-md shadow-sm">
              <input type="text" name="name" placeholder="ユーザー名" class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-l-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
              <button type="submit" class="inline-flex flex-shrink-0 justify-center items-center h-[2.875rem] w-[2.875rem] rounded-r-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-sm">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
              </button>
            </div>
          </div>
    </form>

    @if(isset($userName))
    @foreach($userName as $name)
    <form action="{{ route('record.index') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $name->id }}">
        <input type="hidden" name="name" value="{{ $name->name }}">
        <input type="hidden" name="before" value="search">
        <button type="submit">{{ $name->name }}</button>
    </form>
    @endforeach
    @endif
</body>
