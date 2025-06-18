<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="En imágenes"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <span wire:loading>
        <livewire:utility.spinner />
    </span>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <form class="rounded overflow-hidden shadow-lg px-6 py-6 mt-4 bg-white">
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <div class="bg-green-800  flex items-center justify-center  py-2">
                        <h2 class="xl:text-xl md:text-lg sm:text-md font-semibold leading-7 text-white px-2 py-2">{{$galleryName->title}}</h2>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                        @foreach($imagenes as $image)
                            <div wire:key="{{ $image->id }}" class="card-cs">
                                <img src="{{$image->getUrl()}}"
                                     alt="Imagen no encontrada"
                                     class="cursor-pointer card-cs-img"
                                     id="{{$image->id}}"
                                     wire:click="showImage('{{$image->getUrl()}}')"
                                >
                                @can('fotos delete')
                                <div class="card-cs-footer">
                                    <x-button type="button"
                                              wire:click="deleteGalleryImage({{$image->id}}, {{$galleryName->id}})"
                                              wire:confirm="¿Desea eliminar esta imagen?"
                                              wire:stop
                                              class="mt-2 bg-red-600 hover:bg-red-800">
                                        <x-heroicon-o-trash class="h-4 w-4 text-white"/>
                                    </x-button>
                                </div>
                                @endcan
                            </div>
                        @endforeach

                    </div>
                </div>
                @if ($imagenes->hasPages())
                    <div class="px-6 py-3 bg-gray-200">
                        {{ $imagenes->links() }}
                    </div>
                @endif
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="{{route('galeria')}}" type="button"
                   class="text-sm font-semibold leading-6 text-gray-900">{{__('Volver')}}</a>
            </div>
        </form>
    </div>

    <x-dialog-modal wire:model="showModal" :maxWidth="'6xl'">

        <x-slot name="title">
            <div class="bg-green-800 text-white text-sm text-center border-b rounded-t-lg">
                Imagen: {{$galleryName->title}} </div>
        </x-slot>

        <x-slot name="content">
            <img src="{{$url}}" class="h-full w-full object-cover object-center lg:h-full lg:w-full" alt=""/>
        </x-slot>
        <x-slot name="footer">
            <x-button-cancel wire:click="$set('showModal',false)">
                {{__('Close')}}
            </x-button-cancel>
        </x-slot>
    </x-dialog-modal>


</div>
