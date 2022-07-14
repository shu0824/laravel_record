@extends('layouts.record')
@section('title','ホーム')
@section('content')
//new
<form action="{{ route('image') }}" method="post" enctype="multipart/form-data">
@csrf
<input type="file" name="image">
<input type="submit" value="アップロード">
</form>

<a href="{{ route('post') }}">post</a>
//end
    <div>
        <form class="float-right" action="{{ route('logout') }}" method="post">
            @csrf
            <p>User: {{ session('user_name') }}</p>
            <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">out</button>
        </form>
    </div>

    {{-- カテゴリー選択 --}}
    <div class="bg-white">
        <nav class="flex flex-row">
            @foreach($categories as $category)
            <form action="{{ route('record.index') }}" method="post">
            @csrf
            <button class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none text-gray-500 border-b-2 font-medium hover:border-blue-500">
                {{ $category->category }}
            </button>
            <input name="category" type="hidden" value="{{ $category->category }}">
            </form>
            @endforeach
        </nav>
    </div>

    {{-- カテゴリー --}}
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
          <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-8 md:mb-12">{{ session('select_category') }}</h2>
          <p class="text-center mb-8">{{ count($records) }}件</p>
    {{-- カテゴリーend --}}

    <div class="flex justify-between">
        <div>
            <a href="{{ route('record.addIndex') }}"><button type="button" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">追加する</button></a>
        </div>

        <div class="flex">
            <li class="relative">
                {{-- 並び替え --}}
                <button id="orderBtn" class="mr-5"><i class="fa-solid fa-bars-staggered"></i></button>
                <div id="orderDiv" class="hidden absolute right-0 z-10 bg-white border-gray-400 rounded shadow w-48">
                    @foreach(array('評価順','新しい順','古い順') as $order)
                    <form action="{{ route('record.index') }}" method="post">
                        @csrf
                        <button id="btn" class="py-2.5 px-5 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg  hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" >{{ $order }}</button>
                        <input name="order" type="hidden" value="{{ $order }}">
                    </form>
                    @endforeach
                </div>
            </li>
            <li class="relative">
                {{-- 検索 --}}
                <button id="searchBtn"><i class="fa-solid fa-magnifying-glass"></i></button>
                <div id="searchDiv" class="hidden absolute right-0 z-10 bg-white border-gray-400 rounded shadow w-48">
                    <form action="{{ route('record.index') }}" method="post">
                        @csrf
                        <input
                        name="search_title"
                        type="text"
                        class="relative block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        />
                        <button class="absolute top-2/4 -translate-y-2/4 right-0 py-2.5 px-5 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">検索</button>
                    </form>
                </div>
            </li>
        </div>
    </div>

    {{-- タイトル一覧 --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
        @foreach($records as $record)
        <div>
            <a href="{{ route('record.detail',$record->id)}}" class="group xl:h-96 lg:h-96 h-64 flex items-end bg-gray-100 rounded-lg overflow-hidden shadow-lg relative p-4">
            <img src="data:image/png;base64,{{ $record->image }}" loading="lazy" alt="NoImage" class="w-full h-full object-contain xl:object-cover lg:object-cover object-center absolute inset-0 group-hover:scale-110 transition duration-200" />

            @include('layouts.star')

                <span class="text-gray-800 text-lg lg:text-xl font-bold">{{ $record->title }}</span>
        </div>
        </a>
    </div>
    @endforeach
    {{-- タイトルend --}}

    {{-- javascript --}}
    <script>
        const orderBtn = document.getElementById('orderBtn');
        const orderDiv = document.getElementById('orderDiv');
        const searchBtn = document.getElementById('searchBtn');
        const searchDiv = document.getElementById('searchDiv');

        orderBtn.addEventListener('click',function(){
            orderDiv.classList.toggle('hidden');
            if(!searchDiv.classList.contains('hidden')){
                searchDiv.classList.add('hidden');
            }
        });
        searchBtn.addEventListener('click',function(){
            searchDiv.classList.toggle('hidden');
            if(!orderDiv.classList.contains('hidden')){
                orderDiv.classList.add('hidden');
            }
        });

        // function outFocus(a) {
        //     a.nextElementSibling.classList.add('hidden');
        // }
    </script>
@endsection

