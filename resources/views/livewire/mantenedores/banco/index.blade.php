<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Mantenedor de Bancos"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <div class="grid xl:grid-cols-8 sm:grid-cols-1 md:grid-cols-4">
        <div class="xl:col-start-3 xl:col-span-4 md:col-start-2 md:col-span-2">
            <x-table-dinamic caption="BANCOS">
                <thead class="text-xs text-gray-700 uppercase bg-green-100">
                <tr>
                    <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                        Nombre Banco
                    </th>
                    <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                        @can('bancos create')
                            <button
                                wire:click="OpenModalBancoCreate()"
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
                @foreach($bancos as $banco)
                    <tr wire:key="{{ $banco->id }}" class="border-b border-gray-300 hover:bg-gray-100">

                        <td class="py-4 px-2 text-left whitespace-nowrap border-dashed border-t border-gray-200">
                            <span class="text-gray-700">{{$banco->name}}</span>
                        </td>
                        <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            @can('bancos update')
                                <x-button type="button" wire:click="OpenModalBancoCreate({{ $banco->id }})"
                                          class="m-2 bg-green-600 hover:bg-green-800">
                                    <x-heroicon-o-pencil-square class="h-4 w-4 text-white"/>
                                </x-button>
                            @endcan
                            @can('bancos delete')
                                    <x-button type="button" wire:click="deleteBanco({{$banco->id}})"
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
                    @if ($bancos->hasPages())
                        <div class="px-6 py-3 bg-gray-200">
                            {{ $bancos->links() }}
                        </div>
                    @endif
                </x-slot:paginacion>

            </x-table-dinamic>
        </div>
    </div>

    <x-modal-dinamic
        openCloseModal={{$OpenCloseModal}} title={{$title}}  actionTarget={{$actionTarget}} button={{$buttonBanco}}>
        <x-component-input
            label=""
            placeholder=""
            name="name"
        >
        </x-component-input>
    </x-modal-dinamic>

</div>
