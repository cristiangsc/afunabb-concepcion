<?php

namespace App\Livewire\Roles;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RolePermissionTable extends Component
{
    use WithPagination;
    public function OpenModalRol($role):void
    {
        $this->dispatch('OpenModal', role:$role);
    }

    public function OpenModalPermissionCreate(): void
    {
        $this->dispatch('OpenModalPermission');
    }
    public function OpenModalPermissionEdit($permission): void
    {
        $this->dispatch('OpenModalPermission', permission:$permission);
    }


    public function OpenModalRolCreate(): void
    {
        $this->dispatch('OpenModal');
    }
    public function deleteRole(Role $role): void
    {
        $role->delete();
        $this->render();
    }

    public function AddPermission($role): void
    {
        $this->dispatch('Permission', model_id:$role);
    }

    public function deletePermission(Permission $permission): void
    {
        $permission->delete();
        $this->render();
    }

    #[On('UpdateTableRender')]
    public function render():Renderable
    {
        $roles = Role::withCount('users')->get();
        $permissions = Permission::withCount(['roles','users'])->orderBy('name','ASC')->paginate(10);

        return view('livewire.roles.role-permission-table', compact('roles','permissions'));
    }
}
