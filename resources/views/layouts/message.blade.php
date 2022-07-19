@if(session('message'))
<div id="message" class="w-full h-24 absolute top-0 bg-red-400 text-center py-6">
    <p class="text-lg font-medium align-middle">{{ session('message') }}</p>
</div>
@endif
