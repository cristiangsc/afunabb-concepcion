<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Egresos de Cafeterías"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-2 sm:px-6 lg:px-4">
        <div class="xl:columns-4 lg:columns-4 md:columns-4 sm:columns-1 mx-4">
                <div class="relative mt-1 flex-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor"
                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                  clip-rule="evenodd">
                            </path>
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                           class="bg-gray-50 border border-gray-600 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-800 block w-full pl-10 p-2.5"
                           placeholder="Buscar por año: " wire:model.live="search">
                </div>
        </div>
    </div>


    <div class="grid-container">

        <x-table-dinamic caption="EGRESOS DE CAFETARÍAS">
            <thead class="text-xs text-gray-700 uppercase bg-indigo-100">
            <tr>
                <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                    Año
                </th>
                <th scope="col" class="px-2 py-2 cursor-pointer sticky top-0">
                    Mes
                </th>
                <th scope="col" class="px-4 py-2 cursor-pointer sticky top-0">
                    Facturas
                </th>
                <th scope="col" class="px-4 py-2 cursor-pointer sticky top-0">
                    Impuestos
                </th>
                <th scope="col" class="px-4 py-2 cursor-pointer sticky top-0">
                    Comisión Junaeb
                </th>
                <th scope="col" class="px-4 py-2 cursor-pointer sticky top-0">
                    Remuneraciones
                </th>
                <th scope="col" class="px-4 py-2 cursor-pointer sticky top-0">
                    Imposiciones
                </th>
                <th scope="col" class="px-4 py-2 cursor-pointer sticky top-0">
                    Honorarios Varios
                </th>
                <th scope="col" class="px-4 py-2 cursor-pointer sticky top-0">
                    Total
                </th>
                <th scope="col" class="px-4 py-2 cursor-pointer sticky top-0">
                    Fecha de registro
                </th>
                <th scope="col" class="px-4 py-2 cursor-pointer sticky top-0">
                    Observaciones
                </th>
                <th scope="col" class="px-4 py-2 cursor-pointer sticky top-0">
                    @can('egresosCafeteria create')
                        <button
                            wire:click="OpenModalEgresosCreate()"
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
            @foreach($egresos as $egreso)
                <tr wire:key="{{ $egreso->id }}" class="border-b border-gray-300 hover:bg-gray-100">

                    <td class="py-4 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700"> {{ $egreso->anio }} </span>
                    </td>
                    <td class="py-2 px-2 text-left whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-900 uppercase font-bold"> {{ $egreso->mes }} </span>
                    </td>
                    <td class="py-2 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700"> {{numMiles($egreso->facturas)}} </span>
                    </td>
                    <td class="py-2 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700"> {{numMiles($egreso->impuestos)}} </span>
                    </td>
                    <td class="py-2 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700"> {{numMiles($egreso->comision_junaeb)}} </span>
                    </td>
                    <td class="py-2 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700"> {{numMiles($egreso->remuneraciones)}} </span>
                    </td>
                    <td class="py-2 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700"> {{numMiles($egreso->imposiciones)}} </span>
                    </td>
                    <td class="py-2 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700"> {{numMiles($egreso->honorarios)}} </span>
                    </td>
                    <td class="py-2 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span
                            class="text-gray-700 font-bold"> {{numMiles(sum([$egreso->facturas,$egreso->impuestos,$egreso->comision_junaeb,$egreso->remuneraciones,$egreso->imposiciones,$egreso->honorarios] ))}} </span>
                    </td>
                    <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                            <span
                                class="text-gray-700">{{$egreso->created_at}}</span>
                    </td>
                    <td class="text-left whitespace-nowrap border-dashed border-t border-gray-200">
                        @if(!empty($egreso->observaciones))
                            <span
                                class="text-gray-700"> {{  Str::limit(strip_tags($egreso->observaciones),25,'') }}</span>
                            <span wire:click="OpenModalObservacion('{{ $egreso->observaciones }}')"
                                  class="bg-blue-500 text-white rounded-full font-bold cursor-pointer px-2"><i
                                    class="fa-regular fa-eye"></i>
                                </span>
                        @endif
                    </td>

                    <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200 px-3">
                        @can('egresosCafeteria update')
                            <span wire:click="OpenModalEgresosEdit({{ $egreso->id }})"
                                  class="bg-green-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Editar</span>
                        @endcan
                        @can('egresosCafeteria delete')
                            <span wire:click="deleteEgresos({{$egreso->id}})"
                                  class="bg-red-500 text-white py-1 px-3 rounded-full text-xs cursor-pointer">Eliminar</span>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>

            <x-slot:paginacion>
                @if ($egresos->hasPages())
                    <div class="px-6 py-3 bg-gray-200">
                        {{ $egresos->links() }}
                    </div>
                @endif
            </x-slot:paginacion>
        </x-table-dinamic>

    </div>

    <x-dialog-modal wire:model="showModalObservacion" :maxWidth="'sm'">
        <x-slot name="title">
            <div class="bg-indigo-800 text-white text-center border-b rounded-t-lg">
            </div>
        </x-slot>
        <x-slot name="content">
            <p>{{$observaciones}}</p>
        </x-slot>
        <x-slot name="footer">
            <x-button-cancel type="button" wire:click="$set('showModalObservacion',false)" class="ml-2">
                {{__('Close')}}
            </x-button-cancel>
        </x-slot>
    </x-dialog-modal>


    <x-dialog-modal wire:model="showModal">

        <x-slot name="title">
            <div class="bg-indigo-800 text-white text-center border-b rounded-t-lg"> {{$title}}
            </div>
        </x-slot>

        <x-slot name="content">

            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">

                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6 sm:col-span-3">
                            <x-component-input
                                placeholder=""
                                label="Año"
                                name="anio"
                                type="number"
                            />
                        </div>

                        <div class="col-span-6 sm:col-span-3 mb-4">
                            <label for="mes"
                                   class="block mb-2 text-sm font-medium text-gray-900">Mes</label>
                            <label>
                                <select wire:model="mes"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
                                    <option value="">Seleccione</option>
                                    @foreach($enums as $key => $enum)
                                        @if($mes == $enum)
                                            <option value="{{ $key+1 }}" selected>{{ $enum }}</option>
                                        @else
                                            <option value="{{ $key+1 }}">{{ $enum }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </label>
                            <x-input-error for="mes"/>

                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-component-input
                                placeholder=""
                                label="Facturas"
                                name="facturas"
                                type="text"
                                mask="true"
                            />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-component-input
                                placeholder=""
                                label="Impuestos"
                                name="impuestos"
                                type="text"
                                mask="true"
                            />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-component-input
                                placeholder=""
                                label="Comisión Junaeb"
                                name="comision_junaeb"
                                type="text"
                                mask="true"
                            />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-component-input
                                placeholder=""
                                label="Remuneraciones"
                                name="remuneraciones"
                                type="text"
                                mask="true"
                            />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-component-input
                                placeholder=""
                                label="Imposiciones"
                                name="imposiciones"
                                type="text"
                                mask="true"
                            />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-component-input
                                placeholder=""
                                label="Honorarios varios"
                                name="honorarios"
                                type="text"
                                mask="true"
                            />
                        </div>

                        <div class="col-span-6 sm:col-span-3">

                            <label for="observaciones"
                                   class="block mb-2 text-sm font-medium text-gray-900">Ingrese
                                Observaciones
                                <textarea wire:model="observaciones" name="observaciones" rows="4"
                                          class="shadow-sm mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"></textarea>
                            </label>
                            <x-input-error for="observaciones"/>
                        </div>

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
