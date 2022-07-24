@if(session('message'))
{{-- <div id="message" class="w-full h-24 absolute top-0 bg-red-400 text-center py-6">
    <p class="text-lg font-medium align-middle">{{ session('message') }}</p>
</div> --}}

<div id="message" class="w-full absolute top-0 hs-removing:translate-x-5 hs-removing:opacity-0 transition duration-300 bg-teal-50 border border-teal-200 rounded-md p-4" role="alert">
    <div class="flex">
      <div class="flex-shrink-0">
        <svg class="h-4 w-4 text-teal-400 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </svg>
      </div>
      <div class="ml-3">
        <div class="text-sm text-teal-800 font-medium">
          {{ session('message') }}
        </div>
      </div>
      <div class="pl-3 ml-auto">
        <div class="-mx-1.5 -my-1.5">
          <button type="button" class="inline-flex bg-teal-50 rounded-md p-1.5 text-teal-500 hover:bg-teal-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-teal-50 focus:ring-teal-600" data-hs-remove-element="#dismiss-alert">
            <span class="sr-only">Dismiss</span>

          </button>
        </div>
      </div>
    </div>
  </div>
@endif
