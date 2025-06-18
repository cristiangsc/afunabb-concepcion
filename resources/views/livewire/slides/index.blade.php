<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Slides página principal"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="grid xl:grid-cols-12 lg:grid-cols-12 sm:grid-cols-1 md:grid-cols-4">
            <div class="xl:col-start-1 xl:col-span-12 lg:col-start-1 lg:col-span-12 md:col-start-1 md:col-span-4">
                <form class="rounded overflow-hidden shadow-lg px-6 py-6 mt-4 bg-white">
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <div class="bg-green-800  flex items-center justify-center  py-2">
                                <h2 class="text-base font-semibold leading-7 text-white px-2 py-2">SLIDES</h2>
                                @can('slides create')
                                    <button
                                        wire:click="OpenModalSlide()"
                                        type="button"
                                        class="inline-flex rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-neutral-50">
                                        <svg class="h-7 w-7 text-green-800" xmlns="http://www.w3.org/2000/svg"
                                             fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19,11H13V5a1,1,0,0,0-2,0v6H5a1,1,0,0,0,0,2h6v6a1,1,0,0,0,2,0V13h6a1,1,0,0,0,0-2Z"/>
                                        </svg>
                                    </button>
                                @endcan
                            </div>
                            <div
                                class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2  md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 justify-items-center">
                                @foreach($slides as $slide)
                                    <div wire:key="{{ $slide->id }}"
                                         class="col-span-1 flex flex-col overflow-hidden shadow-lg">
                                        @if($slide->getFirstMediaUrl('slides'))
                                            <img class="w-full h-48 object-cover"
                                                 src="{{$slide->getFirstMediaUrl('slides')}}"
                                                 alt="{{$slide->title}}">
                                        @endif
                                        <p class="ml-2 text-xs font-semibold p-4">TÍTULO: {{$slide->title}}</p>
                                        <div class="flex flex-wrap mt-auto">
                                            @can('slides delete')
                                                <x-button type="button" wire:click="deleteSlide({{$slide->id}})"
                                                          wire:confirm="¿Desea eliminar este Slide?"
                                                          wire:stop
                                                          class="m-2 bg-red-800 hover:bg-red-600">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </x-button>
                                            @endcan
                                            @can('slides update')
                                                <x-button type="button" wire:click="OpenModalSlide({{$slide->id}})"
                                                          class="m-2 bg-green-950 hover:bg-green-800">
                                                    <i class="fa-regular fa-edit"></i>
                                                </x-button>
                                            @endcan
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-dialog-modal wire:model="showModal" :maxWidth="'6xl'">

        <x-slot name="title">
            <div class="bg-green-800 text-white text-center border-b rounded-t-lg"> {{$titleForm}}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                <div class="border-b border-gray-900/10 pb-12">
                    <x-component-input
                        placeholder="Ingrese el Título del Slide"
                        label="Título del Slide"
                        name="title"
                    />
                    <div class="col-span-full">
                        <label for="cover-photo"
                               class="block text-sm font-medium leading-6 text-gray-900">Imagen</label>
                        <div wire:loading wire:target="imagen"
                             class="block text-md text-white bg-red-400 border border-red-400 h-12 items-center p-4 rounded-md relative mb-5"
                             role="alert">
                            <strong class="mr-1">Imagen cargando...</strong> ¡Espere un momento mientras se carga la
                            imagen!
                        </div>
                        <div
                            class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                @if($imagen)
                                    <img src="{{$imagen->temporaryUrl()}}" alt="fotografía" class="md:max-w-screen"/>
                                @endif
                                @if($imagenEdit)
                                    <img class="md:max-w-screen"
                                         src="{{$imagenEdit}}"
                                         alt="{{$title}}">
                                @endif
                                <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                     aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <div class="mt-4 flex justify-center text-sm leading-6 text-gray-600">
                                    <label for="imagen"
                                           class="relative cursor-pointer rounded-md bg-white font-semibold text-green-800 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="imagen" name="imagen" wire:model="imagen" type="file"
                                               class="sr-only">
                                    </label>
                                </div>
                                <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                        <x-input-error for="imagen"/>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button type="button" wire:click="save()" class="ml-2">
                {{__($button)}}
            </x-button>
            <x-button-cancel type="button" wire:click="$set('showModal',false)" class="ml-2">
                {{__('Close')}}
            </x-button-cancel>
        </x-slot>

    </x-dialog-modal>


</div>
