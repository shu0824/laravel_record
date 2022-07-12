@extends('layouts.form')
@section('title','追加')
@section('content')
@if($errors->any())
@foreach ($errors->all() as $error)
<div class="text-center">
    <li class="text-red-500">{{ $error }}</li>
</div>
@endforeach
@endif

<a href="{{ route('record.index') }}">
    <button class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><i class="fa-solid fa-arrow-left"></i></button></a>
<div class="p-6 border border-gray-300 bg-white sm:rounded-md">
    <form action="{{ route('record.add') }}" method="post" enctype="multipart/form-data">
                @csrf
        <label class="block mb-6">
            <span class="text-gray-700">タイトル</span>
            <input
            name="title"
            type="text"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            />
        </label>
        <label class="block mb-6">
            <span class="text-gray-700">得点</span>
            <select
            name="point"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            >
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            </select>
        </label>
        <label class="block mb-6">
            <span class="text-gray-700">カテゴリー</span>
            <input
            name="category"
            type="text"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            list="category"
            autocomplete="off"
            value="{{ session('select_category') }}"
            />
            <datalist id="category">
                @foreach(session('categories') as $category)
                <option value="{{ $category->category }}"></option>
                @endforeach
            </datalist>
        </label>
        <label class="block mb-6">
            <span class="text-gray-700">イメージ</span>
            <img id="preview" src="" alt="プレビュー" class="w-1/4 h-1/4 bg-gray-100 object-cover object-center">
            <input
            name="image"
            type="file"
            onchange="previewImage(this);"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            accept="image/jpeg,image/gif,image/png,"
            />
        </label>
        <label class="block mb-6">
            <span class="text-gray-700">メモ</span>
            <textarea
            name="content"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            rows="5"
            ></textarea>
        </label>
        <div class="mb-6">
            <button
            type="submit"
            class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
            >確定
            </button>
    </form>
</div>

<script>
    function previewImage(a)
    {
    var fileReader = new FileReader();
    fileReader.onload = (function() {
        document.getElementById('preview').src = fileReader.result;
    });
    fileReader.readAsDataURL(a.files[0]);
    }
</script>

@endsection
