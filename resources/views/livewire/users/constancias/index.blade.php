<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Mis constancias"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <div class="grid-container">

            <x-table-dinamic caption="CONSTANCIAS OTORGADAS POR PARTICIPACIÓN">
                <thead class="text-xs text-gray-700 uppercase bg-green-100">
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
                        Fecha Inicio
                    </th>
                    <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                        Fecha Término
                    </th>
                    <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                        Fecha de registro
                    </th>
                    <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                        Descripción
                    </th>
                    <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0 sr-only">Opciones</th>
                </tr>
                </thead>
                <tbody class="text-xxs font-light text-center">
                @foreach($constancias as $constancia)
                    <tr wire:key="{{ $constancia->id }}" class="border-b border-gray-300 hover:bg-gray-100">

                        <td class="py-4 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            <span
                                class="text-gray-700">{{ rutFormat($constancia->rut_id) }} </span>
                        </td>
                        <td class="py-4 px-2 text-left whitespace-nowrap border-dashed border-t border-gray-200 uppercase">
                            <span class="text-gray-700"> {{ $constancia->user->fullNameReverse }} </span>
                        </td>
                        <td class="py-4 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            <span class="text-gray-700"> {{$constancia->reparticion->name}} </span>
                        </td>
                        <td class="py-4 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            <span
                                class="text-gray-700"> {{$constancia->inicio}} </span>
                        </td>
                        <td class="py-4 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            <span
                                class="text-gray-700"> {{$constancia->termino}}</span>
                        </td>
                        <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            <span
                                class="text-gray-700">{{$constancia->created_at}}</span>
                        </td>
                        <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            @if(!empty($constancia->descripcion))
                                <span class="{{$constancia->user->deleted_at ? 'text-white font-bold' : 'text-gray-700'}} uppercase flex items-center gap-x-2"> {{  Str::limit(strip_tags($constancia->descripcion),20,'') }}
                                      <x-heroicon-o-eye wire:click="OpenModalDescripcion('{{ $constancia->descripcion }}')" class="h-6 w-6 ml-1 text-yellow-500 cursor-pointer"/>
                                </span>
                            @endif
                        </td>

                        <td class="text-left whitespace-nowrap border-dashed border-t border-gray-200">
                            <a href="{{ route('constanciapdf',$constancia->id) }}" target="_blank" class="bg-red-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Imprimir</a>
                        </td>

                    </tr>
                @endforeach
                </tbody>

            </x-table-dinamic>

    </div>

    <x-dialog-modal wire:model="showModalDescripcion" :maxWidth="'sm'">
        <x-slot name="title">
            <div class="bg-indigo-800 text-white text-center border-b rounded-t-lg">
            </div>
        </x-slot>
        <x-slot name="content">
            <p class="uppercase">{{$descripcion}}</p>
        </x-slot>
        <x-slot name="footer">
            <x-button-cancel type="button" wire:click="$set('showModalDescripcion',false)" class="ml-2">
                {{__('Close')}}
            </x-button-cancel>
        </x-slot>
    </x-dialog-modal>

</div>
