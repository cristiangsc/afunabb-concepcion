<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Acerca de nuestra Asociación"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="grid xl:grid-cols-12 lg:grid-cols-12 sm:grid-cols-1 md:grid-cols-4">
            <div class="xl:col-start-1 xl:col-span-12 lg:col-start-1 lg:col-span-12 md:col-start-1 md:col-span-4">
                <form class="rounded overflow-hidden shadow-lg px-6 py-6 mt-4 bg-white">
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <div class="bg-green-800 flex items-center justify-center  py-2">
                                <h2 class="xl:text-xl md:text-lg sm:text-md font-semibold leading-7 text-white px-2 py-2">
                                    ASOCIACIÓN DE FUNCIONARIOS NO ACADÉMICOS UNIVERSIDAD DEL BIO-BIO CONCEPCIÓN
                                </h2>
                            </div>
                            <div class="mt-6 grid grid-cols-1 justify-items-center">

                                @if(!empty($about))
                                    @if($about->getFirstMediaUrl('abouts'))
                                        <img class="w-full h-48 object-contain"
                                             src="{{$about->getFirstMediaUrl('abouts')}}"
                                             alt="historia">
                                    @endif

                                    <div class="px-6 py-4 flex flex-wrap mt-auto hover:text-gray-400">
                                        <div class="font-bold text-xl mb-2">HISTORIA DE AFUNABB CONCEPCIÓN</div>
                                        <p class="text-gray-700 text-base text-justify not-italic font-normal">
                                            {!! $about->history !!}
                                        </p>
                                    </div>

                                    <div class="px-6 py-4 flex flex-wrap mt-auto hover:text-gray-400">
                                        <div class="font-bold text-xl mb-2">MISIÓN AFUNABB CONCEPCIÓN</div>
                                        <p class="text-gray-700 text-base text-justify not-italic font-normal">
                                            {!! $about->mission !!}
                                        </p>
                                    </div>

                                    <div class="px-6 py-4 flex flex-wrap mt-auto hover:text-gray-400">
                                        <div class="font-bold text-xl mb-2">VISIÓN AFUNABB CONCEPCIÓN</div>
                                        <p class="text-gray-700 text-base text-justify not-italic font-normal">
                                            {!! $about->vision !!}
                                        </p>
                                    </div>


                                    <div class="flex flex-wrap mt-auto">
                                        @can('acerca update')
                                            <x-button type="button" wire:click="OpenModal({{$about->id}})"
                                                      class="m-2 bg-green-900 hover:bg-green-800">
                                                <i class="fa-regular fa-edit">Editar</i>
                                            </x-button>
                                        @endcan
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <x-dialog-modal wire:model="showModal" :maxWidth="'6xl'">

        <x-slot name="title">
            <div class="bg-green-800 text-white text-center border-b rounded-t-lg"> EDITAR ANTECEDENTES AFUNABB</div>
        </x-slot>

        <x-slot name="content">

            <div class="space-y-6">
                <div class="border-b border-gray-900/10 pb-12">

                    <div class="col-span-full mt-4">
                        <label for="history"></label>
                        <textarea id="history" class="w-full" wire:model="history" rows="10">
                            {!! $history !!}
                        </textarea>
                    </div>

                    <div class="col-span-full mt-4">
                        <label for="mission"></label>
                        <textarea id="mission" class="w-full" wire:model="mission" rows="5">
                            {!! $mission !!}
                        </textarea>
                    </div>

                    <div class="col-span-full mt-4">
                        <label for="vision"></label>
                        <textarea id="vision" class="w-full" wire:model="vision" rows="5">
                            {!! $vision !!}
                        </textarea>
                    </div>


                    <div class="col-span-full">
                        <label for="cover-photo"
                               class="block text-sm font-medium leading-6 text-gray-900">Imagen</label>

                        <div wire:loading wire:target="image"
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
                                    <img class="md:max-w-screen" src="{{$imagenEdit}}" alt="fotografía"/>
                                @endif

                                <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                     aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <div class="mt-4 flex justify-center text-sm leading-6 text-gray-600">
                                    <label for="imagen"
                                           class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
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
                {{__('Update')}}
            </x-button>
            <x-button-cancel type="button" wire:click="$set('showModal',false)" class="ml-2">
                {{__('Close')}}
            </x-button-cancel>
        </x-slot>

    </x-dialog-modal>


</div>
