<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://kit.fontawesome.com/d2664eb908.js" crossorigin="anonymous"></script>
    <title>ユーザー</title>
</head>
<body  class="xl:w-1/2 lg:w-1/2 md:w-1/2 w-full  m-auto mt-16  bg-gray-100 list-none">

    <div>
        <a href="{{ route('record.index') }}">
        <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><i class="fa-solid fa-arrow-left"></i></button></a>
    </div>

    {{-- ユーザー名表示 --}}
    <p>ユーザーネーム：{{ session('user_name') }}</p>

    <ul class="max-w-xs flex flex-col divide-y divide-gray-200 dark:divide-gray-700">
        <a href="{{ route('user.search') }}">
            <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-medium text-gray-800 dark:text-white">
                <button class="font-medium text-gray-900 rounded-lg hover:text-blue-700 focus:z-10">ユーザー検索</button>
            </li>
        </a>
        <a href="{{ route('follow.index') }}">
            <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-medium text-gray-800 dark:text-white">
                <button class="font-medium text-gray-900 rounded-lg hover:text-blue-700 focus:z-10">フォローユーザー</button>
            </li>
        </a>
        <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-medium text-gray-800 dark:text-white">
            <form class="float-right" action="{{ route('logout') }}" method="post">
                @csrf
                <button class="font-medium text-gray-900 rounded-lg hover:text-blue-700 focus:z-10">ログアウト</button>
            </form>
        </li>
        <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-medium text-red-400 dark:text-white">
            <form action="{{ route('record.allDestroy') }}" method="post">
                @csrf
                <button onclick=" return confirm('全てのデータが消えますがよろしいですか？')" class="font-medium text-gray-900 rounded-lg hover:text-blue-700 focus:z-10">アカウントを削除する</button>
            </form>
        </li>
      </ul>
</body>
