<?php

namespace App\Livewire\Roles;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LiveAddPermission extends Component
{
    public bool $showModal = false;
    public array $permission_check = [];
    public $model;

    #[On('Permission')]
    public function addPermission($model_id, $model = null)
    {
        $permissions = Permission::orderBy('name','ASC')->get();
        $this->showModal = true;
        if (!$model) {
            $role = Role::find($model_id);
            $this->model = $role;
            $havePermission = $role->permissions()->get();
            foreach ($permissions as $permission) {
                $havePermission->contains($permission) ? ($this->permission_check[$permission->name]['check'] = true) : ($this->permission_check[$permission->name]['check'] = false);
                $this->permission_check[$permission->name]['id'] = $permission->id;
            }
        }else
        {
            $user = User::find($model_id);
            $this->model = $user;

            $permissions = Permission::with(['roles','users'])->get();

            foreach ($permissions as $p)
            {
               $user->hasPermissionTo($p) ? ($this->permission_check[$p->name]['check'] = true) : ($this->permission_check[$p->name]['check'] = false);
               $this->permission_check[$p->name]['id'] = $p->id;
            }
        }
    }

    public function addPermissionRole($permission)
    {
        if (!$this->model->hasPermissionTo($permission))
        {
            $this->model->givePermissionTo($permission);
        }else
        {
         $this->model->revokePermissionTo($permission);
        }
        $this->dispatch('UpdateTableRender');
    }

    public function closeModal()
    {
        $this->showModal=false;
    }
    public function render()
    {
        return view('livewire.roles.live-add-permission');
    }
}
