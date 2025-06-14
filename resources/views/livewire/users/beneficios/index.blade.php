<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Mis Beneficios otorgados"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <div class="grid-container">

            <x-table-dinamic caption="LISTADO DE MIS BENEFICIOS OTORGADOS">
                <thead class="text-xs text-gray-700 uppercase bg-indigo-100">
                <tr>
                    <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                        Rut
                    </th>
                    <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                        Nombres
                    </th>
                    <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                        Repartición
                    </th>
                    <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                        Beneficio
                    </th>
                    <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                        Monto $
                    </th>
                    <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                        Observaciones
                    </th>
                    <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                        Fecha Asignación
                    </th>

                </tr>
                </thead>
                <tbody class="text-xs font-light text-center">
                @foreach($beneficios as $beneficio)
                    <tr wire:key="{{ $beneficio->id }}" class="border-b border-gray-300 hover:bg-gray-100">

                        <td class="py-4 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            <span class="text-gray-700">{{ rutFormat($beneficio->rut_id) }} </span>
                        </td>
                        <td class="py-4 px-2 text-left whitespace-nowrap border-dashed border-t border-gray-200 uppercase">
                            <span class="text-gray-700"> {{ $beneficio->user->fullName }} </span>
                        </td>
                        <td class="py-4 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            <span class="text-gray-700"> {{$beneficio->reparticion->name}} </span>
                        </td>
                        <td class="py-4 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            <span class="text-gray-700"> {{$beneficio->beneficio->name}} </span>
                        </td>
                        <td class="py-4 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            <span class="text-gray-700"> {{numMiles($beneficio->monto)}} </span>
                        </td>
                        <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            @if(!empty($beneficio->observacion))
                                <span class="text-gray-700"> {{  Str::limit(strip_tags($beneficio->observacion),25,'') }}</span>
                                <span wire:click="OpenModalDescripcion('{{ $beneficio->observacion }}')"
                                      class="bg-blue-500 text-white rounded-full font-bold cursor-pointer px-2"><i class="fa-regular fa-eye"></i>
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            <span class="text-gray-700"> {{($beneficio->fecha_asignacion)}} </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </x-table-dinamic>
    </div>

    <x-dialog-modal wire:model="showModalDescripcion" :maxWidth="'sm'">
        <x-slot name="title">
            <div class="bg-indigo-800 text-white text-center border-b rounded-t-lg"></div>
        </x-slot>
        <x-slot name="content">
            <p>{{$observacion}}</p>
        </x-slot>
        <x-slot name="footer">
            <x-button-cancel type="button" wire:click="$set('showModalDescripcion',false)" class="ml-2">
                {{__('Close')}}
            </x-button-cancel>
        </x-slot>
    </x-dialog-modal>

</div>
