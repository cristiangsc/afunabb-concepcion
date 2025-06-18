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
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                              clip-rule="evenodd">
                        </path>
                    </svg>
                </div>
                <input type="text" id="table-search"
                       class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-800 block w-full pl-10 p-2.5"
                       placeholder="Buscar por galería: " wire:model.live="search">
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
                            <a href="{{route('show',$gallery->id)}}"
                               class="bg-yellow-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Ver</a>
                        @endcan
                        @can('galeria update')
                            <span wire:click="OpenModalGalleryCreate({{ $gallery->id }})"
                                  class="bg-green-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Editar</span>
                        @endcan
                        @can('galeria create')
                            <a href="{{route('upload',$gallery->id)}}"
                               class="bg-blue-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Agregar</a>
                        @endcan
                        @can('galeria delete')
                            <span wire:click="deleteGallery({{$gallery->id}})"
                                  class="bg-red-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Eliminar</span>
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

