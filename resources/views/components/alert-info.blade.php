    <div class="block text-md text-white bg-blue-400 border border-blue-400-400 h-12 items-center p-4 rounded-md relative mb-5" role="alert">
        <strong class="mr-1">{{$subtitle}}</strong> {{ $message }}
        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
        </button>
    </div>
