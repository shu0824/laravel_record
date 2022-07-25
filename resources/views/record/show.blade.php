@extends('layouts.app')
@section('title','詳細')
@section('content')
@foreach($records as $record)
<div class="flex justify-between bg-white">
    <div>
        <a href="{{ route('record.index') }}">
        <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><i class="fa-solid fa-arrow-left"></i></button></a>
    </div>
    @if(session('user_id' == Auth::id()))
    <div class="flex">
        <form method="post">
            @csrf
            <button type="submit" formaction="{{ route('record.edit') }}" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><i class="fa-solid fa-pen-to-square"></i></button>
            <input id="deleteSub" type="hidden" formaction="{{ route('record.destroy') }}">
            <button id="deleteBtn" formaction="{{ route('record.destroy') }}" onclick=" return confirm('削除してよろしいですか？')" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><i class="fa-solid fa-trash"></i></button>
        </form>
    </div>
    @endif
</div>
<div class="h-full bg-white py-6 sm:py-8 lg:py-12">
        <div class="max-w-screen-xl px-4 md:px-8 mx-auto">
          <div class="grid md:grid-cols-2 gap-8 lg:gap-12">
            <div>
              <div class="h-full md:h-auto bg-gray-100 overflow-hidden rounded-lg shadow-lg">
                @if(isset($record->image_path))
                <img src="{{ $record->image_path }}" loading="lazy" alt="NoImage" class="w-full h-full  object-contain object-center" />
                @else
                <img src="{{ asset('img/noImage.jpeg') }}" loading="lazy" alt="NoImage" class="w-full h-full  object-contain object-center" />
                @endif
              </div>
            </div>

            <div class="md:pt-8">

              <h1 class="text-gray-800 text-2xl sm:text-3xl font-bold text-center md:text-left mb-4 md:mb-6">{{ $record->title }}</h1>

                @include('layouts.star')

              <h2 class="text-gray-500 text-xl sm:text-2xl font-semibold text-center md:text-left mb-2 md:mb-4">メモ</h2>

              <p class="text-gray-800 sm:text-lg mb-6 md:mb-8 text-left">{{ $record->content }}</p>
            </div>
          </div>
        </div>
      </div>
@endforeach

 @endsection
