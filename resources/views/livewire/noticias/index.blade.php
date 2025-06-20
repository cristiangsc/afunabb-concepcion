<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-8">
            <div>
                <x-principal.header title="AFUNABB" subtitle="Noticias"/>
            </div>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <span wire:loading>
        <livewire:utility.spinner/>
    </span>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <livewire:noticias.carousel/>

            <div class="xl:visible lg:visible md:visible invisible  m-4">
                <label for="table-search" class="sr-only">Buscar</label>
                <div class="relative mt-1 flex-1 pr-3">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <x-codicon-search class="h-5 w-5 text-green-800" />
                    </div>
                    <input type="text"  class="bg-gray-50 border border-green-600 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-800 block w-full pl-10 p-2.5"
                           placeholder="Buscar Noticias"  wire:model.live.debounce.300ms="searching">
                </div>
            </div>

        <div class="grid-container">
            <form class="rounded overflow-hidden shadow-lg px-6 py-6 mt-4 bg-white">
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <div class="bg-green-800  flex items-center justify-center  py-2">
                            <h2 class="xl:text-xl md:text-lg sm:text-md font-semibold leading-7 text-white px-2 py-2">
                                NOTICIAS DE ACTUALIDAD
                            </h2>
                            @can('noticias create')
                                <button
                                    wire:click="OpenModal()"
                                    type="button"
                                    class="inline-flex rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-neutral-50">
                                    <svg class="h-7 w-7 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19,11H13V5a1,1,0,0,0-2,0v6H5a1,1,0,0,0,0,2h6v6a1,1,0,0,0,2,0V13h6a1,1,0,0,0,0-2Z"/>
                                    </svg>
                                </button>
                            @endcan
                        </div>

                        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2  md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 justify-items-center">
                            @foreach($noticias as $noticia)
                                <div wire:key="{{ $noticia->id }}" class="col-span-1 flex flex-col overflow-hidden shadow-lg">
                                    @if($noticia->getFirstMediaUrl('noticias'))
                                        <img class="w-full h-48 object-cover"
                                             src="{{$noticia->getFirstMediaUrl('noticias')}}"
                                             alt="{{$noticia->title}}">
                                    @endif
                                    <a href="{{route('noticias.ver',$noticia->id)}}"
                                       class="px-6 py-4 flex flex-wrap mt-auto hover:text-gray-400">
                                        <div class="font-bold text-md mb-2 uppercase">{{$noticia->title}}</div>
                                        <div class="mt-2">
                                            <p class="text-gray-700 text-md text-justify not-italic font-normal">
                                                {{  Str::limit(strip_tags($noticia->body),150,'...') }}
                                            </p>
                                        </div>
                                    </a>

                                    <div class="px-6 pt-4 flex flex-wrap mt-auto mb-2">
                                        <div class="text-sm text-left">
                                            <hr class="mb-2">
                                            <p class="text-gray-900 leading-none text-xs not-italic font-normal uppercase">
                                                Escrito por: {{$noticia->user->fullName}}</p>
                                            <span class="inline-block text-xs leading-none text-gray-700 not-italic font-normal">Fecha: {{ \Carbon\Carbon::parse($noticia->created_at)->format('d/m/Y')}}</span>
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap mt-auto">
                                        @can('noticias delete')
                                            <x-button type="button" wire:click="deleteNoticia({{$noticia->id}})"
                                                      wire:confirm="¿Desea eliminar esta noticia?"
                                                      wire:stop
                                                      class="m-2 bg-red-800 hover:bg-red-600">
                                                <x-heroicon-o-trash class="h-4 w-4 text-white"/>
                                            </x-button>
                                        @endcan
                                        @can('noticias update')
                                            <x-button type="button" wire:click="OpenModal({{$noticia->id}})"
                                                      class="m-2 bg-green-950 hover:bg-green-800">
                                                <x-heroicon-o-pencil-square class="h-4 w-4 text-white"/>
                                            </x-button>
                                        @endcan
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    @if ($noticias->hasPages())
                        <div class="px-6 py-3 bg-gray-200">
                            {{ $noticias->links() }}
                        </div>
                    @endif
                </div>

            </form>


        </div>
    </div>

    <livewire:noticias.create/>

</div>

