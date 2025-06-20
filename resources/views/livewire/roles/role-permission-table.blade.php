<div>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-10">
            <x-principal.header title="AFUNABB" subtitle="Role and permission management"/>
            <x-fecha-hoy/>
        </div>
    </x-slot>

    <div class="grid-container">

        <x-table-dinamic caption="ROLES">

            <thead class="text-xs text-gray-700 uppercase bg-green-100">
            <tr>
                <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                    Id
                </th>
                <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                    Nombre rol
                </th>
                <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                    Usos
                </th>
                <th scope="col" class="px-6 py-2 cursor-pointer sticky top-0">
                    @can('role create')
                        <button
                            wire:click="OpenModalRolCreate()"
                            type="button"
                            class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-neutral-50"
                        >
                            <svg class="h-7 w-7 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
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
            @foreach($roles as $role)
                <tr wire:key="{{ $role->id }}" class="border-b border-gray-300 hover:bg-gray-100">
                    <td class="py-4 px-2 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700"> {{ $role->id }} </span>
                    </td>
                    <td class="text-left whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700">{{$role->name}}</span>
                    </td>
                    <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700">{{$role->users_count}}</span>
                    </td>
                    <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        @can('role update')
                            <x-button type="button" wire:click="OpenModalRol({{ $role->id }})"
                                      class="m-2 bg-green-500 hover:bg-green-800">
                                <x-heroicon-o-pencil-square class="h-4 w-4 text-white"/>
                            </x-button>
                        @endcan
                            <x-button type="button" wire:click="AddPermission({{ $role->id }})"
                                      class="m-2 bg-purple-800 hover:bg-purple-600">
                                <x-codicon-shield class="h-4 w-4 text-white"/>
                            </x-button>
                        @can('role delete')
                            @if(!$role->users_count && canView('role delete'))
                                <x-button type="button" wire:click="deleteRole({{$role->id}})"
                                          wire:confirm="¿Desea eliminar este rol?"
                                          wire:stop
                                          class="m-2 bg-red-800 hover:bg-red-600">
                                    <x-heroicon-o-trash class="h-4 w-4 text-white"/>
                                </x-button>
                            @endif
                        @endcan
                    </td>

                </tr>
            @endforeach
            </tbody>

        </x-table-dinamic>

        <x-table-dinamic caption="PERMISOS">

            <thead class="text-xs text-gray-700 uppercase bg-green-100">
            <tr>
                <th scope="col" class="py-2 cursor-pointer sticky top-0">
                    Nombre Permiso
                </th>
                <th scope="col" class="py-2 cursor-pointer sticky top-0">
                    Usos
                </th>
                <th scope="col" class="py-2 cursor-pointer sticky top-0">
                    @can('permisos create')
                        <button
                            wire:click="OpenModalPermissionCreate()"
                            type="button"
                            class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-neutral-50"
                        >
                            <svg class="h-7 w-7 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
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
            @foreach($permissions as $p)
                <tr wire:key="{{ $p->id }}" class="border-b border-gray-300 hover:bg-gray-100">

                    <td class="px-6 whitespace-nowrap text-left border-dashed border-t border-gray-200">
                        <span class="text-gray-700 ">{{$p->name}}</span>
                    </td>
                    <td class="text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        <span class="text-gray-700">{{$p->users_count + $p->roles_count}}</span>
                    </td>
                    <td class="py-4 px-4 text-center whitespace-nowrap border-dashed border-t border-gray-200">
                        @can('permisos update')
                            <x-button type="button" wire:click="OpenModalPermissionEdit({{ $p->id }})"
                                      class="m-2 bg-green-500 hover:bg-green-800">
                                <x-heroicon-o-pencil-square class="h-4 w-4 text-white"/>
                            </x-button>
                        @endcan

                        @can('permisos delete')
                            @if(!$p->users_count && !$p->roles_count && canView('role delete'))
                                <x-button type="button" wire:click="deletePermission({{$p->id}})"
                                          wire:confirm="¿Desea eliminar esta noticia?"
                                          wire:stop
                                          class="m-2 bg-red-800 hover:bg-red-600">
                                    <x-heroicon-o-trash class="h-4 w-4 text-white"/>
                                </x-button>
                            @endif
                        @endcan
                    </td>

                </tr>
            @endforeach
            </tbody>

            <x-slot:paginacion>
                @if ($permissions->hasPages())
                    <div class="px-6 py-3 bg-gray-200">
                        {{ $permissions->links() }}
                    </div>
                @endif
            </x-slot:paginacion>

        </x-table-dinamic>

    </div>

    @push('modals')
        <livewire:roles.live-modal-edit-role-permission/>
        <livewire:roles.live-add-permission/>
    @endpush
</div>


