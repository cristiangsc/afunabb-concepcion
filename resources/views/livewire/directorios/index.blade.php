<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Directorio"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-2 sm:px-6 lg:px-4">
        <div class="columns-4">
            <div class="xl:visible lg:visible md:visible invisible">
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
                           placeholder="Buscar por rut: " wire:model.live="search">
                </div>
            </div>
        </div>
    </div>

    <div class="grid-container">
        <x-table-dinamic caption="LISTADO DE DIRECTORES Y DIRECTORAS">
            <thead class="text-xs text-gray-700 uppercase bg-indigo-100">
            <tr>
                <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                    Rut
                </th>
                <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                    Nombres
                </th>
                <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                    Cargo
                </th>
                <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                    Fecha Inicio
                </th>
                <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                    Fecha Termino
                </th>
                <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                    Estado
                </th>

                <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                    @can('directiva create')
                        <button wire:click="OpenModalDirectorioCreate()"
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
            <tbody class="text-xs font-light text-center">
            @foreach($directorios as $directorio)
                <tr wire:key="{{ $directorio->id }}"
                    class="border-b {{$directorio->user->deleted_at ? 'bg-red-400 hover:bg-red-800' : 'border-gray-300 hover:bg-gray-100'}}">

                    <td class="py-4 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span
                            class="{{$directorio->user->deleted_at ? 'text-white font-bold' : 'text-gray-700'}}">{{ rutFormat($directorio->rut_id) }} </span>
                    </td>
                    <td class="py-4 px-2 text-left whitespace-nowrap border-dashed border-t border-gray-200 uppercase">
                        <span
                            class="{{$directorio->user->deleted_at ? 'text-white font-bold' : 'text-gray-700'}}"> {{ $directorio->user->fullName }} </span>
                    </td>
                    <td class="py-4 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200 uppercase">
                        <span
                            class="{{$directorio->user->deleted_at ? 'text-white font-bold' : 'text-gray-700'}}"> {{$directorio->cargo}} </span>
                    </td>
                    <td class="py-4 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span
                            class="{{$directorio->user->deleted_at ? 'text-white font-bold' : 'text-gray-700'}}"> {{$directorio->inicio}} </span>
                    </td>
                    <td class="py-4 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span
                            class="{{$directorio->user->deleted_at ? 'text-white font-bold' : 'text-gray-700'}}"> {{$directorio->termino}} </span>
                    </td>
                    <td class="py-4 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            <span
                                class="{{ $directorio->estado == 'Vigente' ? 'bg-purple-800': 'bg-red-800'}} text-white py-1 px-3 rounded-full text-xs uppercase font-bold"> {{$directorio->estado}}  </span>
                    </td>

                    <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">

                        @can('directiva update')
                            <span wire:click="OpenModalDirectorioEdit({{ $directorio->id }})"
                                  class="bg-green-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Editar</span>
                        @endcan

                        @can('directiva delete')
                            <span wire:click="deleteDirectorio({{$directorio->id}})"
                                  class="bg-red-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Eliminar</span>
                        @endcan

                    </td>

                </tr>
            @endforeach
            </tbody>

            <x-slot:paginacion>
                @if ($directorios->hasPages())
                    <div class="px-6 py-3 bg-gray-200">
                        {{ $directorios->links() }}
                    </div>
                @endif
                <p class="text-white ml-2">Lineas destacadas de color rojo corresponde a soci@ que ya no pertenece a la
                    Asociación</p>
            </x-slot:paginacion>

        </x-table-dinamic>


    </div>

    <x-dialog-modal wire:model="showModal">

        <x-slot name="title">
            <div class="bg-indigo-800 text-white text-center border-b rounded-t-lg"> {{$title}} </div>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">

                    @if($button == 'Update')
                        <x-input-disabled
                            placeholder=""
                            label="Rut"
                            name="rut_id"
                            type="text"
                        />

                    @else
                        <div class="grid grid-cols-2 items-end gap-4 pb-3">
                            <x-component-input
                                placeholder=""
                                label="Rut"
                                name="rut_id"
                                type="text"
                            />
                            <div>
                                <x-button type="submit" wire:click="searchUser">Buscar</x-button>
                            </div>
                        </div>
                    @endif

                    <x-input-disabled
                        placeholder=""
                        label="Nombre"
                        name="nombres"
                        type="text"
                    />

                    <div class="col-span-6 sm:col-span-3">
                        <label for="cargo"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargo</label>
                        <label>
                            <select wire:model="cargo"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                                <option value="">Seleccione</option>
                                @foreach($enumsCargos as $key => $enum)
                                    @if($cargo == $enum)
                                        <option value="{{ $key+1 }}" selected>{{ $enum }}</option>
                                    @else
                                        <option value="{{ $key+1 }}">{{ $enum }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </label>
                        <x-input-error for="cargo"/>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="estado"
                               class="block mb-2 text-sm font-medium text-gray-900">Estado</label>
                        <label>
                            <select wire:model="estado"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                                <option value="">Seleccione</option>
                                @foreach($enumsEstados as $key => $enumE)
                                    @if($estado == $enumE)
                                        <option value="{{ $key+1 }}" selected>{{ $enumE }}</option>
                                    @else
                                        <option value="{{ $key+1 }}">{{ $enumE }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </label>
                        <x-input-error for="estado"/>
                    </div>

                    <div class="col-span-6 sm:col-span-3 mb-3">
                        <x-component-input
                            placeholder=""
                            label="Fecha Inicio"
                            name="inicio"
                            type="date"
                        />
                    </div>

                    <div class="col-span-6 sm:col-span-3 mb-3">
                        <x-component-input
                            placeholder=""
                            label="Fecha Término"
                            name="termino"
                            type="date"
                        />
                    </div>

                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="store" type="button">
                {{__($button)}}
            </x-button>
            <x-button-cancel type="button" wire:click="$set('showModal',false)" class="ml-2">
                {{__('Close')}}
            </x-button-cancel>
        </x-slot>
    </x-dialog-modal>

</div>
