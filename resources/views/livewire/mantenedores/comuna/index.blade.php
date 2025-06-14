<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Mantenedor de Comunas"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

   <div class="grid-container">
            <x-table-dinamic caption="COMUNAS">
                <thead class="text-xs text-gray-700 uppercase bg-indigo-100">
                <tr>

                    <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                        Nombre Comuna
                    </th>
                    <th scope="col" class="py-2 cursor-pointer sticky top-0">
                        Nombre Región
                    </th>
                    <th scope="col" class="py-2 cursor-pointer sticky top-0">
                        Nº Región
                    </th>
                    <th scope="col" class="px-4 py-2 cursor-pointer sticky top-0">
                        @can('comunas create')
                            <button
                                wire:click="OpenModalComunaCreate()"
                                type="button"
                                class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-neutral-50">
                                <svg class="h-7 w-7 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19,11H13V5a1,1,0,0,0-2,0v6H5a1,1,0,0,0,0,2h6v6a1,1,0,0,0,2,0V13h6a1,1,0,0,0,0-2Z"/>
                                </svg>
                            </button>
                        @endcan
                    </th>
                </tr>
                </thead>
                <tbody class="text-xs font-light">
                @foreach($comunas as $comuna)
                    <tr wire:key="{{ $comuna->id }}" class="border-b border-gray-300 hover:bg-gray-100">

                        <td class="py-4 px-2 text-left whitespace-nowrap border-dashed border-t border-gray-200">
                            <span class="text-gray-700">{{$comuna->name}}</span>
                        </td>
                        <td class="text-left whitespace-nowrap border-dashed border-t border-gray-200">
                            <span class="text-gray-700">{{$comuna->region}}</span>
                        </td>
                        <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            <span class="text-gray-700">{{$comuna->cod_region}}</span>
                        </td>
                        <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            @can('comunas update')
                                <span wire:click="OpenModalComunaCreate({{ $comuna->id }})"
                                      class="bg-green-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Editar</span>
                            @endcan
                            @can('comunas delete')
                                <span wire:click="deleteComuna({{$comuna->id}})"
                                      class="bg-red-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Eliminar</span>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>

                <x-slot:paginacion>
                    @if ($comunas->hasPages())
                        <div class="px-6 py-3 bg-gray-200">
                            {{ $comunas->links() }}
                        </div>
                    @endif
                </x-slot:paginacion>

            </x-table-dinamic>

    </div>

    <x-modal-dinamic
        openCloseModal={{$OpenCloseModal}} title={{$title}}  actionTarget={{$actionTarget}} button={{$buttonComuna}}>
        <x-component-input
            label="Nombre Comuna"
            placeholder=""
            name="name"
        >
        </x-component-input>

        <x-component-input
            label="Nombre Región"
            placeholder=""
            name="region"
        >
        </x-component-input>

        <x-component-input
            label="Número de Región"
            placeholder=""
            name="cod_region"
        >
        </x-component-input>

    </x-modal-dinamic>


</div>
