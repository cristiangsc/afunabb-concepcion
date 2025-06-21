<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="En imágenes"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-2 sm:px-6 lg:px-4">
        <div class="xl:columns-2 sm:columns-1 mx-4">
            <div class="relative mt-1 flex-1 pr-3">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-codicon-search class="h-5 w-5 text-green-800" />
                </div>
                <input type="text" id="table-search"
                       class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-800 block w-full pl-10 p-2.5"
                       placeholder="Buscar por galería: " wire:model.live.debounce.300ms="search">
            </div>
        </div>
    </div>

    <div class="grid-container">
        <x-table-dinamic caption="GALERÍA DE IMÁGENES">
            <thead class="text-xs text-gray-700 uppercase bg-green-100">
            <tr>
                <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0" wire:click="order('title')">
                    <span class="inline-flex items-center gap-1">
                        <x-heroicon-c-arrows-up-down class="h-4 w-4"/>
                            Nombre Galería
                    </span>
                    <x-sort sort="{{ $sort }}" direction="{{ $direction }}" campo='title'></x-sort>
                </th>
                <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0" wire:click="order('created_at')">
                  <span class="inline-flex items-center gap-1">
                        <x-heroicon-c-arrows-up-down class="h-4 w-4"/>
                            Fecha creación
                  </span>
                    <x-sort sort="{{ $sort }}" direction="{{ $direction }}" campo='created_at'></x-sort>
                </th>
                <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                    @can('galeria create')
                        <button
                            wire:click="OpenModalGalleryCreate()"
                            type="button"
                            class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-neutral-50">
                            <svg class="h-7 w-7 text-green-800" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19,11H13V5a1,1,0,0,0-2,0v6H5a1,1,0,0,0,0,2h6v6a1,1,0,0,0,2,0V13h6a1,1,0,0,0,0-2Z"/>
                            </svg>
                        </button>
                    @endcan
                </th>
            </tr>
            </thead>
            <tbody class="text-xs font-light text-center">
            @foreach($galleries as $gallery)
                <tr wire:key="{{ $gallery->id }}" class="border-b border-gray-300 hover:bg-gray-100">

                    <td class="py-4 px-4 text-left whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700">{{$gallery->title}}</span>
                    </td>
                    <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700">{{$gallery->created_at}}</span>
                    </td>
                    <td class="text-center pr-2 whitespace-nowrap border-dashed border-t border-gray-200">
                        @can('galeria read')
                        <x-button type="button" onclick="window.location.href='{{ route('show',$gallery->id) }}'"
                                  class="m-2 bg-yellow-500 hover:bg-yellow-700">
                            <x-heroicon-o-eye class="h-4 w-4 text-white"/>
                        </x-button>
                        @endcan
                        @can('galeria update')
                            <x-button type="button" wire:click="OpenModalGalleryCreate({{ $gallery->id }})"
                                      class="m-2 bg-green-600 hover:bg-green-800">
                                <x-heroicon-o-pencil-square class="h-4 w-4 text-white"/>
                            </x-button>
                        @endcan
                        @can('galeria create')
                                <x-button type="button" onclick="window.location.href='{{ route('upload',$gallery->id) }}'"
                                          class="m-2 bg-blue-600 hover:bg-blue-800">
                                    <x-heroicon-s-arrow-up-circle class="h-4 w-4 text-white" />
                                </x-button>
                        @endcan
                        @can('galeria delete')
                            <x-button type="button" wire:click="deleteGallery({{$gallery->id}})"
                                      class="m-2 bg-red-800 hover:bg-red-600"
                                      wire:confirm="¿Desea eliminar este registro?">>
                                <x-heroicon-o-trash class="h-4 w-4 text-white"/>
                            </x-button>
                        @endcan
                    </td>

                </tr>
            @endforeach
            </tbody>

            <x-slot:paginacion>
                @if ($galleries->hasPages())
                    <div class="px-6 py-3 bg-gray-200">
                        {{ $galleries->links() }}
                    </div>
                @endif
            </x-slot:paginacion>

        </x-table-dinamic>

    </div>

    <x-modal-dinamic
        openCloseModal={{$OpenCloseModal}} title={{$titleModal}}  actionTarget={{$actionTarget}} button={{$buttonGallery}}>
        <x-component-input
            label=""
            placeholder=""
            name="title"
        >
        </x-component-input>
    </x-modal-dinamic>

</div>

