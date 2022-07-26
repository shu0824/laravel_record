@extends('layouts.app')
@section('title','ホーム')
@section('content')
@include('layouts.message')

{{-- other --}}
@if(session('user_id') != Auth::id())
<div>
    @if(session('before') == 'search')
    <a href="{{ route('user.search') }}">
    @elseif(session('before') == 'follow')
    <a href="{{ route('follow.index') }}">
    @endif
    <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><i class="fa-solid fa-arrow-left"></i></button></a>
</div>
@endif

<div>
    {{-- me --}}
    @if(session('user_id') == Auth::id())
    <div class="float-right">
        <span>User:{{ session('user_name') }}</span>
        <a href="{{ route('user.index') }}">
            <span class="inline-block h-[3.875rem] w-[3.875rem] bg-gray-100 rounded-full overflow-hidden">
                <svg class="h-full w-full text-gray-300" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.62854" y="0.359985" width="15" height="15" rx="7.5" fill="white"/>
                    <path d="M8.12421 7.20374C9.21151 7.20374 10.093 6.32229 10.093 5.23499C10.093 4.14767 9.21151 3.26624 8.12421 3.26624C7.0369 3.26624 6.15546 4.14767 6.15546 5.23499C6.15546 6.32229 7.0369 7.20374 8.12421 7.20374Z" fill="currentColor"/>
                    <path d="M11.818 10.5975C10.2992 12.6412 7.42106 13.0631 5.37731 11.5537C5.01171 11.2818 4.69296 10.9631 4.42107 10.5975C4.28982 10.4006 4.27107 10.1475 4.37419 9.94123L4.51482 9.65059C4.84296 8.95684 5.53671 8.51624 6.30546 8.51624H9.95231C10.7023 8.51624 11.3867 8.94749 11.7242 9.62249L11.8742 9.93184C11.968 10.1475 11.9586 10.4006 11.818 10.5975Z" fill="currentColor"/>
                </svg>
                </span>
        </a>
    </div>

    {{-- other --}}
    {{-- フォローしている場合 --}}
    @elseif(session('follow'))
    <form class="float-right" action="{{ route('follow.destroy') }}" method="post">
        @csrf
        <div>
            <a href="{{ route('user.index') }}">User:
                {{ session('user_name') }}
            </a>
        </div>
        <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">followNow</button>
    </form>
    {{-- フォローしていない場合 --}}
    @else
    <form class="float-right" action="{{ route('follow') }}" method="post">
        @csrf
        <div>
            <a href="{{ route('user.index') }}">User:
                {{ session('user_name') }}
            </a>
        </div>
        <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">follow</button>
    </form>
    @endif
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

<div class="flex justify-between">

    {{-- 作品追加 --}}
    @if(session('user_id') == Auth::id())
    <div>
        <a href="{{ route('record.create') }}"><button type="button" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">追加する</button></a>
    </div>
    @endif

    <div class="flex">
        <li class="relative">
            {{-- 並び替え --}}
            <button id="orderBtn" class="mr-5"><i class="fa-solid fa-bars-staggered"></i></button>
            {{-- me --}}
            @if(session('user_id') == Auth::id())
            <div id="orderDiv" class="hidden absolute right-0 z-10 bg-white border-gray-400 rounded shadow w-48 divide-y divide-gray-200 dark:divide-gray-700">
            {{-- other --}}
            @else
            <div id="orderDiv" class="hidden absolute left-0 z-10 bg-white border-gray-400 rounded shadow w-48 divide-y divide-gray-200 dark:divide-gray-700">
            @endif
                @foreach(array('評価順','新しい順','古い順') as $order)
                <form action="{{ route('record.index') }}" method="post">
                    @csrf
                    <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-medium text-gray-800 dark:text-white">
                        <button id="btn" class=" text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg  hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" >{{ $order }}</button>
                    <input name="order" type="hidden" value="{{ $order }}">
                    </li>
                </form>
                @endforeach
            </div>
        </li>
        <li class="relative">
            {{-- 検索 --}}
            <button id="searchBtn"><i class="fa-solid fa-magnifying-glass"></i></button>
            {{-- me --}}
            @if(session('user_id') == Auth::id())
            <div id="searchDiv" class="hidden absolute right-0 z-10 bg-white border-gray-400 rounded shadow w-48">
            {{-- other --}}
            @else
            <div id="searchDiv" class="hidden absolute left-0 z-10 bg-white border-gray-400 rounded shadow w-48">
            @endif
                <form action="{{ route('record.index') }}" method="post">
                    @csrf
                    <div>
                        <div class="flex rounded-md shadow-sm">
                          <input type="text" name="search_title" placeholder="タイトル" class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-l-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                          <button type="submit" class="inline-flex flex-shrink-0 justify-center items-center h-[2.875rem] w-[2.875rem] rounded-r-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-sm">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                          </button>
                        </div>
                      </div>
                </form>
            </div>
        </li>
    </div>
</div>

{{-- タイトル一覧 --}}
<div class="h-full grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
    @foreach($records as $record)
    <div>
        <a href="{{ route('record.show',$record->id)}}" class="group xl:h-96 lg:h-96 h-64 flex items-end bg-gray-100 rounded-lg overflow-hidden shadow-lg relative p-4">
        @if(isset($record->image_path))
        <img src="{{ $record->image_path }}" loading="lazy" alt="NoImage" class="w-full h-full object-contain xl:object-cover lg:object-cover object-center absolute inset-0 group-hover:scale-110 transition duration-200" />
        @else
        <img src="{{ asset('img/noImage.jpeg') }}" loading="lazy" alt="NoImage" class="w-full h-full object-contain xl:object-cover lg:object-cover object-center absolute inset-0 group-hover:scale-110 transition duration-200" />
        @endif

        @include('layouts.star')

        <span class="text-gray-800 text-sm lg:text-xl xl:text-lg font-bold">{{ $record->title }}</span>
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
    const message = document.getElementById('message');

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

    setTimeout(function(){
        message.classList.add('hidden');
    },1000);
</script>
@endsection

