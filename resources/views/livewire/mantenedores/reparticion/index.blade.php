<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Mantenedor Reparticiones"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-2 sm:px-6 lg:px-4">
        <div class="xl:columns-2 lg:columns-2 md:columns-1 sm:columns-1 mx-4">
            <div class="relative mt-1 flex-1">
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
                       placeholder="Buscar por repartición: " wire:model.live="search">
            </div>
        </div>
    </div>


    <div class="grid-container">
        <x-table-dinamic caption="REPARTICIONES">
            <thead class="text-xs text-gray-700 uppercase bg-green-100">
            <tr>
                <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                    Nombre Repartición
                </th>
                <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                    @can('reparticion create')
                        <button
                            wire:click="OpenModalReparticionCreate()"
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
            @foreach($reparticiones as $reparticion)
                <tr wire:key="{{ $reparticion->id }}" class="border-b border-gray-300 hover:bg-gray-100">

                    <td class="py-4 px-2 text-left whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700">{{$reparticion->name}}</span>
                    </td>
                    <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        @can('reparticion update')
                            <x-button type="button" wire:click="OpenModalReparticionCreate({{ $reparticion->id }})"
                                      class="m-2 bg-green-600 hover:bg-green-800">
                                <x-heroicon-o-pencil-square class="h-4 w-4 text-white"/>
                            </x-button>
                        @endcan
                        @can('reparticion delete')
                            <x-button type="button" wire:click="deleteReparticion({{$reparticion->id}})"
                                      class="m-2 bg-red-800 hover:bg-red-600"
                                      wire:confirm="¿Desea eliminar este registro?">
                                <x-heroicon-o-trash class="h-4 w-4 text-white"/>
                            </x-button>
                        @endcan
                    </td>

                </tr>
            @endforeach
            </tbody>

            <x-slot:paginacion>
                @if ($reparticiones->hasPages())
                    <div class="px-6 py-3 bg-gray-200">
                        {{ $reparticiones->links() }}
                    </div>
                @endif
            </x-slot:paginacion>

        </x-table-dinamic>
    </div>


    <x-modal-dinamic
        openCloseModal={{$OpenCloseModal}} title={{$title}}  actionTarget={{$actionTarget}} button={{$buttonReparticion}}>
        <x-component-input
            label=""
            placeholder=""
            name="name"
        >
        </x-component-input>
    </x-modal-dinamic>


</div>
