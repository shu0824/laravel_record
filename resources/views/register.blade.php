<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://kit.fontawesome.com/d2664eb908.js" crossorigin="anonymous"></script>
    <title>新規登録</title>
</head>
<body  class="xl:w-1/2 lg:w-1/2 md:w-1/2 w-full  m-auto mt-16  bg-gray-100 list-none">
    @if($errors->any())
    @foreach ($errors->all() as $error)
    <div class="text-center">
        <li class="text-red-500">{{ $error }}</li>
    </div>
    @endforeach
    @endif
    <div class="p-6 border border-gray-300 bg-white sm:rounded-md">
        <form action="{{ route('register') }}" method="post">
        @csrf
            <label class="block mb-6">
                <span class="text-gray-700">ユーザーネーム</span>
                <input
                name="name"
                type="text"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                />
            </label>
            <label class="block mb-6">
                <span class="text-gray-700">メールアドレス</span>
                <input
                name="email"
                type="email"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                />
            </label>
            <label class="block mb-6">
                <span class="text-gray-700">パスワード</span>
                <input
                name="password"
                type="password"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                />
            </label>
            <label class="block mb-6">
                <span class="text-gray-700">パスワード（確認用）</span>
                <input
                name="password_confirmation"
                type="password"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                />
            </label>
            <div class="flex justify-between">
                <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">登録</button>
                <a href="{{ route('login') }}" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900  hover:text-blue-700 focus:z-10 dark:text-gray-400  dark:hover:text-white">ログイン
                </a>
            </div>
        </form>
    </div>
</body>
