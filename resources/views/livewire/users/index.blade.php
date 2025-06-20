<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Listado de soci@s"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="relative overflow-x-auto shadow-md md:rounded-lg bg-green-800">
                <div class="p-4 flex items-center">
                    <span class="text-md text-white mr-2">
                        Mostar
                    </span>
                    <div class="mr-3 text-sm">
                        <label>
                            <select wire:model.live="cant"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500">
                                <option value="5">5</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </label>
                    </div>

                    <div class="w-full">
                        <livewire:utility.search-input wire:model.live="search"/>
                    </div>

                    @can('usuarios create')
                        <button
                            wire:click="showModalCreate()"
                            type="button"
                            class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-neutral-50"
                        >
                            <svg class="h-7 w-7 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/>
                            </svg>
                        </button>
                    @endcan

                </div>

                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead class="text-xs text-gray-700 uppercase bg-green-100">
                    <tr>
                        <th scope="col" class="px-3 py-3 cursor-pointer sticky top-0">
                            Avatar
                        </th>

                        <th scope="col" class="px-6 py-3 cursor-pointer sticky top-0" wire:click="order('rut')">
                             <span class="inline-flex items-center gap-1">
                        <x-heroicon-c-arrows-up-down class="h-4 w-4"/>
                            Rut
                            <x-sort sort="{{ $sort }}" direction="{{ $direction }}" campo='rut'></x-sort>
                             </span>
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer sticky top-0" wire:click="order('nombre')">
                            <div class="flex">
                                 <span class="inline-flex items-center gap-1">
                        <x-heroicon-c-arrows-up-down class="h-4 w-4"/>
                                Nombres
                                <x-sort sort="{{ $sort }}" direction="{{ $direction }}" campo='nombre'></x-sort>
                                 </span>
                            </div>

                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer sticky top-0" wire:click="order('paterno')">
                            <div class="flex whitespace-nowrap">
                                 <span class="inline-flex items-center gap-1">
                                      <x-heroicon-c-arrows-up-down class="h-4 w-4"/>
                                         Paterno
                                      <x-sort sort="{{ $sort }}" direction="{{ $direction }}" campo='paterno'></x-sort>
                                 </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer sticky top-0" wire:click="order('materno')">
                            <div class="flex whitespace-nowrap">
                                 <span class="inline-flex items-center gap-1">
                                    <x-heroicon-c-arrows-up-down class="h-4 w-4"/>
                                     Materno
                                    <x-sort sort="{{ $sort }}" direction="{{ $direction }}" campo='materno'></x-sort>
                                 </span>
                            </div>
                        </th>
                        <th scope="col" class="px-3 py-3 cursor-pointer sticky top-0" wire:click="order('sede_id')">
                             <span class="inline-flex items-center gap-1">
                                <x-heroicon-c-arrows-up-down class="h-4 w-4"/>
                                Sede
                                <x-sort sort="{{ $sort }}" direction="{{ $direction }}" campo='sede_id'></x-sort>
                             </span>
                        </th>
                        <th scope="col" class="px-3 py-3 cursor-pointer sticky top-0">
                            Rol
                        </th>
                        <th scope="col" class="px-6 py-3 sticky top-0">
                            @can('socios export')
                                <button wire:click="exportUser()"
                                        class="flex rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-green-700 hover:bg-gray-50 focus:outline-neutral-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-green-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25"/>
                                    </svg>
                                    <span class="mt-1">Exportar</span>
                                </button>
                            @endcan
                        </th>
                    </tr>
                    </thead>

                    <tbody class="text-xs font-light text-center">

                    @forelse($users as $user)
                        <tr wire:key="{{ $user->id }}"
                            class="border-b {{$user->deleted_at ? 'bg-red-400 hover:bg-red-500' : 'border-gray-300 hover:bg-gray-100'}}">

                            <td class="py-3  text-center whitespace-nowrap border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-3 py-2 flex items-center">
                                    @if($user->profile_photo_path)
                                        <img class="rounded-full w-10 h-10"
                                             src="{{ asset('storage/'.$user->profile_photo_path) }}" alt="Avatar">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-green-900">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    @endif
                                </span>
                            </td>

                            <td
                                class="py-2 px-6 text-center whitespace-nowrap border-dashed border-t border-gray-200 ">
                                <span
                                    class="{{$user->deleted_at ? 'text-white font-bold' : 'text-gray-700'}} px-6 py-2 flex items-center">{{ rutFormat($user->rut) }}</span>
                            </td>
                            <td
                                class="py-2 px-2 text-left whitespace-nowrap border-dashed border-t border-gray-200">
                                <span
                                    class="{{$user->deleted_at ? 'text-white font-bold' : 'text-gray-700'}} px-6 py-2 flex items-center uppercase">{{ ($user->nombre) }} </span>
                            </td>
                            <td
                                class="py-2 px-2 text-left whitespace-nowrap border-dashed border-t border-gray-200">
                                <span
                                    class="{{$user->deleted_at ? 'text-white font-bold' : 'text-gray-700'}} px-6 py-2 flex items-center uppercase">{{ ($user->paterno) }}</span>
                            </td>
                            <td
                                class="py-2 px-2 text-left whitespace-nowrap border-dashed border-t border-gray-200">
                                <span
                                    class="{{$user->deleted_at ? 'text-white font-bold' : 'text-gray-700'}} px-6 py-2 flex items-center uppercase"> {{ ($user->materno) }}</span>
                            </td>
                            <td
                                class="py-2 px-2 text-left whitespace-nowrap border-dashed border-t border-gray-200">
                                <span
                                    class="{{$user->deleted_at ? 'text-white font-bold' : 'text-gray-700'}} px-6 py-2 flex items-center uppercase">{{ $user->sede->name }}</span>
                            </td>
                            <td
                                class="py-2 px-6 text-left whitespace-nowrap border-dashed border-t border-gray-200">

                                @php
                                    $roles = $user->getRoleNames();
                                    $esSocio = $roles->contains('socio');
                                @endphp

                                <span class=" py-1 px-3 rounded-full text-md font-bold {{ $user->deleted_at ? 'text-white font-bold bg-red-600' : ($esSocio ? 'bg-green-600 text-white' : 'bg-red-500 text-white') }}">
                                    {{ $user->deleted_at ? 'NO ES SOCI@' : $roles->implode(', ') }}
                                </span>

                            </td>

                            <td class="px-2 py-2 border-dashed border-t border-gray-200">
                                @if(! $user->deleted_at)

                                    <div class="flex item-center justify-center cursor-pointer gap-4">
                                        <div class="w-4 mr-2 transform hover:text-green-500 hover:scale-110">
                                            <a href="javascript:void(0)" wire:click="showModalView({{$user->id}})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor" class="w-6 h-6 text-green-900">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        @can('usuarios update')
                                            <div
                                                class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                                <a href="javascript:void(0)" wire:click="showModalEdit({{$user->id}})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor"
                                                         class="w-6 h-6 text-purple-900">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        @endcan
                                        @can('usuarios delete')
                                            <div
                                                class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer">
                                                <a href="javascript:void(0)" wire:click="userDelete({{ $user->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor" class="w-6 h-6 text-red-700">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        @endcan
                                        @can('role update')
                                            <div
                                                class="w-4 mr-2 transform hover:text-grey-500 hover:scale-110 cursor-pointer">
                                                <a href="javascript:void(0)"
                                                   wire:click="AddPermission({{ $user->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor" class="w-7 h-7 text-black-700">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M14.43,4.57l1-1L12.78.94l-1,1h0l-.87.88h0l-1,1h0L7.84,5.89A5,5,0,1,0,9.11,7.16L11.2,5.07l1.36,1.37,1-1L12.19,4.08l.88-.87ZM5,13.6A3.6,3.6,0,1,1,8.6,10,3.6,3.6,0,0,1,5,13.6Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                @else
                                    @can('usuarios restaurar')
                                        <div
                                            class=" transform hover:text-purple-500 hover:scale-110 cursor-pointer btn-cyan p-0.5 mb-0.5">
                                            <a href="javascript:void(0)" wire:click="restaurarSocio({{$user->id}})"
                                               class="flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1"
                                                     viewBox="0 0 24 24" class="w-6 h-6">
                                                    <path
                                                        d="m23,4h-6v-1.5c0-1.378-1.121-2.5-2.5-2.5h-5c-1.379,0-2.5,1.122-2.5,2.5v1.5H1v1h1.551l1.799,16.767c.137,1.273,1.205,2.233,2.485,2.233h10.295c1.277,0,2.346-.958,2.485-2.229l1.833-16.771h1.552v-1Zm-15-1.5c0-.827.673-1.5,1.5-1.5h5c.827,0,1.5.673,1.5,1.5v1.5h-8v-1.5Zm10.621,19.163c-.084.763-.725,1.337-1.491,1.337H6.835c-.768,0-1.409-.576-1.491-1.34L3.556,5h16.886l-1.821,16.663Zm-11.05-7.769c-.769-.769-.769-2.019,0-2.787l3.202-3.203.707.707-3.202,3.203c-.057.057-.106.12-.146.187h5.367c1.379,0,2.5,1.122,2.5,2.5v4.5h-1v-4.5c0-.827-.673-1.5-1.5-1.5h-5.367c.04.067.089.129.146.187l3.202,3.203-.707.707-3.202-3.203Z"/>
                                                </svg>
                                                <span class="text-white font-bold"> Reactivar</span>
                                            </a>
                                        </div>

                                        <div
                                            class="transform hover:text-purple-500 hover:scale-110 cursor-pointer btn-red p-0.5">
                                            <a href="javascript:void(0)" wire:click="borradoSocio({{$user->id}})"
                                               class="flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke="currentColor" class="w-6 h-6 text-white">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                <span class="text-white font-bold"> Borrado Definitivo</span>
                                            </a>
                                        </div>
                                    @endcan
                                @endif
                            </td>

                        </tr>
                    @empty

                        <div class="px-6 py-4 text-white">
                            No hay coincidencias
                        </div>
                    @endforelse

                    </tbody>

                </table>
                @if ($users->hasPages())
                    <div class="px-6 py-3 bg-gray-200">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>
    @push('modals')
        <livewire:users.create/>
        <livewire:users.show/>
        <livewire:roles.live-add-permission/>
    @endpush


</div>
