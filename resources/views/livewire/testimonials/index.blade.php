<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Ingresa tu testimonios"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <div class="grid-container">
            <x-table-dinamic caption="MIS TESTIMONIOS">
                <thead class="text-xs text-gray-700 uppercase bg-indigo-100">
                <tr>
                    <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                        Testimonios
                    </th>
                    <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                        Fecha Creación
                    </th>
                    <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                        <button
                            wire:click="OpenModalTestimonyCreate()"
                            type="button"
                            class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-neutral-50">
                            <svg class="h-7 w-7 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19,11H13V5a1,1,0,0,0-2,0v6H5a1,1,0,0,0,0,2h6v6a1,1,0,0,0,2,0V13h6a1,1,0,0,0,0-2Z"/>
                            </svg>
                        </button>
                    </th>
                </tr>
                </thead>
                <tbody class="text-xs font-light text-center">
                @foreach($testimonials as $testimony)
                    <tr class="border-b border-gray-300 hover:bg-gray-100">
                        <td class="py-4 px-2 text-left  border-dashed border-t border-gray-200">
                            <span class="text-gray-700"> {{ $testimony->testimony }} </span>
                        </td>
                        <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            <span class="text-gray-700">{{$testimony->created_at}}</span>
                        </td>
                        <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200 p-2">
                            <span wire:click="OpenModalTestimonyCreate({{ $testimony->id }})"
                                  class="bg-green-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Editar</span>
                            <span wire:click="deleteTestimony({{$testimony->id}})"
                                  wire:confirm="¿Desea eliminar este registro?"
                                  wire:stop
                                  class="bg-red-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Eliminar</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </x-table-dinamic>
    </div>

    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            <div class="bg-indigo-800 text-white text-sm text-center border-b rounded-t-lg"> Testimonios </div>
        </x-slot>

        <x-slot name="content">
            <label for="testimony"></label>
            <textarea id="testimony" class="w-full" wire:model="testimonio" rows="5">
                            {!! $testimonio !!}
            </textarea>
            <span>Mínimo 20 caracteres</span>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="createTestimony()">
                {{__('Save all')}}
            </x-button>
            <x-button-cancel wire:click="$set('showModal',false)" class="ml-2">
                {{__('Close')}}
            </x-button-cancel>
        </x-slot>
    </x-dialog-modal>

</div>
