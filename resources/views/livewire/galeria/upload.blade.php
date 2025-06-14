<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Subir imágenes"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <div class="grid xl:grid-cols-8 lg:grid-cols-8 sm:grid-cols-1 md:grid-cols-4 mb-3">
        <div class="xl:col-start-3 xl:col-span-4 lg:col-start-2 lg:col-span-6 md:col-start-1 md:col-span-4">

            <form  class="rounded overflow-hidden shadow-lg px-6 py-6 mt-4 bg-white" >
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">

                        <div class="bg-indigo-600">
                        <h2 class="text-base font-semibold leading-7 text-white px-2 py-2">Nombre de la Galería</h2>
                        <p class="text-sm leading-6 text-white px-2 pb-2">{{$gallery->title}}</p>
                        </div>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                            <div class="col-span-full">
                                <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Imagen</label>

                                <div wire:loading wire:target="image" class="block text-md text-white bg-red-400 border border-red-400 h-12 items-center p-4 rounded-md relative mb-5" role="alert">
                                    <strong class="mr-1">Imagen cargando...</strong> ¡Espere un momento mientras se carga la imagen!
                                </div>

                                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                    <div class="text-center">
                                        @if($image)
                                            <img src="{{$image->temporaryUrl()}}" alt="fotografía" class="md:max-w-screen"/>
                                        @endif
                                        <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                        </svg>
                                        <div class="mt-4 flex justify-center text-sm leading-6 text-gray-600">
                                            <label for="image" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                <span>Upload a file</span>
                                                <input id="image" name="image" wire:model="image" type="file" class="sr-only">

                                            </label>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 3MB</p>
                                    </div>
                                </div>

                                <x-input-error for="image"/>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <x-button wire:click="store" wire:loading.attr="disabled" wire:target="store, image" type="button" > {{__('Save all')}}</x-button>
                    <a href="{{route('galeria')}}"  type="button" class="inline-flex items-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700 focus:bg-orange-700 active:bg-orange-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150">{{__('Cancel')}}</a>
                </div>
            </form>


        </div>
    </div>
</div>
