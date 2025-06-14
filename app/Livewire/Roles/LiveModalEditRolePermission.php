<?php

namespace App\Livewire\Roles;

use App\Http\Requests\RequestCreatePermission;
use App\Http\Requests\RequestCreateRole;
use App\Http\Requests\RequestUpdateRole;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class LiveModalEditRolePermission extends Component
{
    public bool $OpenCloseModal = false;
    public Role $role;
    public string $name = '';
    public string $button = '';
    public string $actionTarget = '';
    public string $title = '';
    public Permission $permission;

    #[On('OpenModal')]
    public function toogleModalRole(Role $role = null): void
    {
        $this->name='';
        $this->resetErrorBag();
        $this->resetValidation();
        if (!empty($role->name)) {
            $this->role = $role;
            $this->name = $role->name;
            $this->button = 'Update';
            $this->actionTarget = 'updateRole';
            $this->title = 'Role Edition';
        }else
        {
            $this->button = 'Save all';
            $this->actionTarget = 'createRole';
            $this->title = 'Creación de Rol';
        }
        $this->OpenCloseModal = !$this->OpenCloseModal;
    }

    public function createRole(): void
    {
       $request = new RequestCreateRole;
       $values = $this->validate($request->rules(),$request->messages());
       Role::create(['name'=>$values['name']]);
       $this->reset('name','button','actionTarget','title','OpenCloseModal');
       $this->dispatch('UpdateTableRender');
    }
    public function updateRole(): void
    {
        $request = new RequestUpdateRole;
        $values = $this->validate($request->rules(), $request->messages());
        $this->role->update(['name'=>$values['name']]);
        $this->reset('name','button','actionTarget','title','OpenCloseModal');
        $this->dispatch('UpdateTableRender');
    }



// Modulo creación y actualización de permisos


    #[On('OpenModalPermission')]
    public function toogleModalPermission(Permission $permission = null): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
        if (!empty($permission->name)) {
            $this->permission = $permission;
            $this->name = $permission->name;
            $this->button = 'Update';
            $this->actionTarget = 'updatePermission';
            $this->title = 'Permission Edition';
        }else
        {
            $this->button = 'Save all';
            $this->actionTarget = 'createPermission';
            $this->title = 'Creación de Permisos';
        }
        $this->OpenCloseModal = !$this->OpenCloseModal;
    }

    public function createPermission(): void
    {
        $request = new RequestCreatePermission;
        $values = $this->validate($request->rules(),$request->messages());
        Permission::create(['name'=>$values['name']]);
        $this->reset('name','button','actionTarget','title','OpenCloseModal');
        $this->dispatch('UpdateTableRender');
    }
    public function updatePermission(): void
    {
        $request = new RequestCreatePermission;
        $values = $this->validate($request->rules($this->permission), $request->messages());
        $this->permission->update(['name'=>$values['name']]);
        $this->reset('name','button','actionTarget','title','OpenCloseModal');
        $this->dispatch('UpdateTableRender');
    }


    public function render():Renderable
    {
        return view('livewire.roles.live-modal-edit-role-permission');
    }
}
