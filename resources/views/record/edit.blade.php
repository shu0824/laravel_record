@extends('layouts.form')
@section('title','更新')
@section('content')

<a href="{{ route('record.index') }}">
<button class="absolute top-0 py-2.5 px-5 mr-2  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"><i class="fa-solid fa-arrow-left"></i></button></a>
<form action="{{ route('record.update') }}" method="post" enctype="multipart/form-data" class="mb-20">
@csrf
    @foreach($records as $record)
    <div class="p-6 pt-16 border border-gray-300 bg-white sm:rounded-md">
        <label class="block mb-6">
            <span class="text-gray-700">タイトル</span>
            <input
            name="title"
            type="text"
            value="{{ $record->title }}"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            />
            @include('layouts.error',[
                'errors' => $errors,
                'error' => 'title'
            ])
        </label>
        <label class="block mb-6">
            <span class="text-gray-700">得点</span>
            <select
            name="point"
            value="{{ $record->point }}"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            >
            <option selected>{{ $record->point }}</option>
            @for($i=1; $i<=5; $i++)
                @continue($i==$record->point)
            <option>{{ $i }}</option>
            @endfor
            </select>
        </label>
        <label class="block mb-6">
            <span class="text-gray-700">カテゴリー</span>
            <input
            name="category"
            type="text"
            value="{{ $record->category }}"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            list="category"
            autocomplete="off"
            />
            <datalist id="category">
                @foreach(session('categories') as $category)
                <option value="{{ $category->category }}"></option>
                @endforeach
            </datalist>
            @include('layouts.error',[
                'errors' => $errors,
                'error' => 'category'
            ])
        </label>
        <img id="preview" src="{{ asset('/storage/'.$record->image) }}" alt="プレビュー" class="w-1/4 h-1/4 bg-gray-100 object-cover object-center">
        <label class="block mb-6">
            <span class="text-gray-700">イメージ</span>
            <input
            name="image"
            type="file"
            onchange="previewImage(this);"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            accept="image/jpeg,image/gif,image/png"
            />
        </label>
        <label class="block mb-6">
            <span class="text-gray-700">メモ</span>
            <textarea
            name="content"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            rows="8"
            >{{ $record->content }}</textarea>
        </label>
        <div class="mb-6">
            <button
            class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
            >変更
            </button>
        </div>
        @endforeach
</form>

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
