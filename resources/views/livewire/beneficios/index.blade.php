<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Beneficios sociales"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-2 sm:px-6 lg:px-4">
        <div class="xl:columns-2 lg:columns-2 sm:columns-1 mx-4">
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
                           placeholder="Buscar por nombre beneficio: " wire:model.live="search">
                </div>
        </div>
    </div>

    <div class="grid-container">
        <x-table-dinamic caption="BENEFICIOS SOCIALES">
            <thead class="text-xs text-gray-700 uppercase bg-indigo-100">
            <tr>
                <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                    Nombre Beneficio
                </th>
                <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                    Fecha Creación
                </th>
                <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                    Estado
                </th>
                <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                    @can('beneficios create')
                        <button
                            wire:click="OpenModalBeneficioCreate()"
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
            @foreach($benefits as $benefit)
                <tr class="border-b border-gray-300 hover:bg-gray-100">
                    <td class="py-4 px-2 text-left whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700"> {{ $benefit->name }} </span>
                    </td>
                    <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700">{{$benefit->fecha}}</span>
                    </td>
                    <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="{{$benefit->vigencia ?'bg-purple-500':'bg-yellow-500'}} text-white py-1 px-3 rounded-full text-xs">{{$benefit->vigencia ? 'Vigente' : ' No vigente'}}</span>
                    </td>
                    <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        @can('beneficios update')
                            <span wire:click="OpenModalBeneficioCreate({{ $benefit->id }})"
                                  class="bg-green-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Editar</span>
                        @endcan
                        @can('beneficios delete')
                            <span wire:click="deleteBeneficio({{$benefit->id}})"
                                  wire:confirm="¿Desea eliminar este registro?"
                                  wire:stop
                                  class="bg-red-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Eliminar</span>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
            <x-slot:paginacion>
                @if ($benefits->hasPages())
                    <div class="px-6 py-3 bg-gray-200">
                        {{ $benefits->links() }}
                    </div>
                @endif
            </x-slot:paginacion>
        </x-table-dinamic>
    </div>


    <x-dialog-modal wire:model="showModal">

        <x-slot name="title">
            <div class="bg-indigo-800 text-white text-sm text-center border-b rounded-t-lg"> Beneficios</div>
        </x-slot>

        <x-slot name="content">
            <x-component-input
                label="Nombre Beneficio"
                placeholder=""
                name="name"
            >
            </x-component-input>

            <x-component-input
                label="Fecha de creación"
                placeholder=""
                name="fecha"
                type="date"
            >
            </x-component-input>

            <div class="block mt-4">
                <label for="vigencia" class="flex items-center">
                    <x-checkbox id="vigencia" name="vigencia" wire:model="vigencia"/>
                    <span
                        class="ml-2 text-sm text-gray-600">{{ __('Marque la casilla si el beneficio está vigente') }}</span>
                </label>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="createBenefict()">
                {{__('Save all')}}
            </x-button>
            <x-button-cancel wire:click="$set('showModal',false)" class="ml-2">
                {{__('Close')}}
            </x-button-cancel>
        </x-slot>
    </x-dialog-modal>

</div>

