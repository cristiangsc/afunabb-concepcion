<div>

     <a href="#" wire:click="$set('open','true')" class="inline-flex items-center justify-center p-5 text-base font-medium text-gray-500 rounded-lg bg-gray-50 hover:text-gray-900 hover:bg-gray-100">
        <img src="{{ asset('assets/images/logoB.png') }}" class="w-8 h-8 me-3" alt="Logo Afunabb">
        <span class="w-full">DIRECTORIO AFUNABB CONCEPCIÓN</span>
        <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
    </a>


    <x-dialog-modal wire:model="open" maxWidth="4xl">

        <x-slot name="title">
            <div class="mb-10 text-center">
                <h2 class="mb-4 text-center text-2xl text-green-800 font-bold md:text-4xl uppercase">Directorio Afunabb Concepción </h2>
                <p class="text-gray-800 lg:w-8/12 lg:mx-auto">Universidad del Bío-Bío</p>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="py-8 bg-gray-50">
                <div class="container mx-auto px-2 md:px-6 xl:px-12">

                    <div class="grid gap-8 items-center md:grid-cols-3">
                        @foreach($directorios as $director)
                            <div class="space-y-4 text-center">
                                @if($director->user->profile_photo_path)
                                    <img
                                        class="w-40 h-40 mx-auto object-cover rounded-xl md:w-40 md:h-40 lg:w-40 lg:h-40"
                                        src="{{asset('/storage/'.$director->user->profile_photo_path)}}"
                                        alt="Avatar director/a"/>
                                @else
                                    <img
                                        class="w-40 h-40 mx-auto object-cover rounded-xl md:w-40 md:h-40 lg:w-40 lg:h-40"
                                        src="{{asset('assets/images/avatar.png')}}" alt="Avatar director/a"/>
                                @endif
                                <div>
                                    <h4 class="text-1xl text-gray-800">{{$director->user->fullName}}</h4>
                                    <span class="block text-sm text-gray-500">Cargo:{{$director->cargo}}</span>
                                    <span class="block text-sm text-gray-500"> {{$director->user->email}}</span>
                                </div>
                            </div>
                        @endforeach
                        <div class="space-y-4">
                            <img class="mx-auto"
                                 src="{{asset('assets/images/logo.png')}}" alt="logo"/>
                        </div>
                    </div>
                </div>
            </div>


        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open',false)" class="mr-2">
                {{__("Cerrar")}}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
