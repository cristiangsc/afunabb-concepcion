<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Mantenedor Tipos de cuentas"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <div class="grid xl:grid-cols-8 sm:grid-cols-1 md:grid-cols-4">
        <div class="xl:col-start-3 xl:col-span-4 md:col-start-2 md:col-span-2">
            <x-table-dinamic caption="CUENTAS">
                <thead class="text-xs text-gray-700 uppercase bg-green-100">
                <tr>
                    <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                        Tipo de Cuenta
                    </th>
                    <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                        @can('cuentas create')
                            <button
                                wire:click="OpenModalCuentaCreate()"
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
                @foreach($cuentas as $cuenta)
                    <tr wire:key="{{ $cuenta->id }}" class="border-b border-gray-300 hover:bg-gray-100">

                        <td class="py-4 px-2 text-left whitespace-nowrap border-dashed border-t border-gray-200">
                            <span class="text-gray-700">{{$cuenta->name}}</span>
                        </td>
                        <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            @can('cuentas update')
                                <span wire:click="OpenModalCuentaCreate({{ $cuenta->id }})"
                                      class="bg-green-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Editar</span>
                            @endcan
                            @can('cuentas delete')
                                <span wire:click="deleteCuenta({{$cuenta->id}})"
                                      class="bg-red-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Eliminar</span>
                            @endcan
                        </td>

                    </tr>
                @endforeach
                </tbody>

            </x-table-dinamic>
        </div>

    </div>

    <x-modal-dinamic
        openCloseModal={{$OpenCloseModal}} title={{$title}}  actionTarget={{$actionTarget}} button={{$buttonCuenta}}>
        <x-component-input
            label=""
            placeholder=""
            name="name"
        >
        </x-component-input>
    </x-modal-dinamic>


</div>
