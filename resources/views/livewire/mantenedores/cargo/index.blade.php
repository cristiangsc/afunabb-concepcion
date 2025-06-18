<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Mantenedor de Cargos"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

   <div class="grid-container">
            <x-table-dinamic caption="CARGOS">
                <thead class="text-xs text-gray-700 uppercase bg-green-100">
                <tr>
                    <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                        Nombre Cargo
                    </th>
                    <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                        @can('cargos create')
                            <button
                                wire:click="OpenModalCargoCreate()"
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
                @foreach($cargos as $cargo)
                    <tr wire:key="{{ $cargo->id }}" class="border-b border-gray-300 hover:bg-gray-100">

                        <td class=" py-4 px-2 text-left whitespace-nowrap border-dashed border-t border-gray-200">
                            <span class="text-gray-700">{{$cargo->name}}</span>
                        </td>
                        <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            @can('cargos update')
                                <span wire:click="OpenModalCargoCreate({{ $cargo->id }})"
                                      class="bg-green-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Editar</span>
                            @endcan
                            @can('cargos delete')
                                <span wire:click="deleteCargo({{$cargo->id}})"
                                      class="bg-red-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Eliminar</span>
                            @endcan
                        </td>

                    </tr>
                @endforeach
                </tbody>

            </x-table-dinamic>

</div>

    <x-modal-dinamic
        openCloseModal={{$OpenCloseModal}} title={{$title}}  actionTarget={{$actionTarget}} button={{$buttonCargo}}>
        <x-component-input
            label=""
            placeholder=""
            name="name"
        >
        </x-component-input>
    </x-modal-dinamic>


</div>
