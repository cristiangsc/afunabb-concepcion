<?php

namespace App\Livewire\Users;

use App\Http\Requests\RequestUser;
use App\Models\User;
use App\Notifications\MessageNewUser;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Contracts\Support\Renderable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Traits\GenericTrait;

class Create extends Component
{
    use GenericTrait;
    use LivewireAlert;

    public ?User $user = null;
    public string $rut ='';
    public string $nombre='';
    public string $paterno='';
    public string $materno='';
    public string $direccion='';
    public string $telefono='';
    public string $password='';
    public string $passwordComparar='';
    public string $num_cuenta='';
    public string $calidad='';
    public string $email='';
    public $fecha_nacimiento;
    public $fecha_ingreso_ubb;
    public $fecha_ingreso_afunabb;
    public  $sede_id = '';
    public  $reparticion_id = '';
    public  $cargo_id = '';
    public  $comuna_id = '';
    public  $cuenta_id = '';
    public  $banco_id = '';

    public string $title='';
    public string $action='';
    public string $method= '';
    public bool $showModal = false;
    public array $roles = [];
    public array $role = [];
    public array $enums = [];

    protected $listeners = ['confirmed'];

    #[On('showModalEdit')]
    public function showModalEditUser(User $user): void
    {
        $this->user = $user;
        $this->rut = rutFormat($user->rut);
        $this->nombre = $user->nombre;
        $this->paterno = $user->paterno;
        $this->materno = $user->materno;
        $this->direccion = $user->direccion;
        $this->telefono = $user->telefono ? :'';
        $this->fecha_nacimiento = formatoFecha($user->fecha_nacimiento);
        $this->fecha_ingreso_ubb = formatoFecha($user->fecha_ingreso_ubb);
        $this->fecha_ingreso_afunabb = formatoFecha($user->fecha_ingreso_afunabb);
        $this->num_cuenta = $user->num_cuenta;
        $this->password = $user->password;
        $this->passwordComparar = $user->password;
        $this->sede_id = $user->sede_id;
        $this->reparticion_id = $user->reparticion_id;
        $this->cargo_id = $user->cargo_id;
        $this->comuna_id = $user->comuna_id;
        $this->cuenta_id = $user->cuenta_id;
        $this->calidad = $user->calidad;
        $this->banco_id = $user->banco_id;
        $this->email = $user->email;
        $this->title = "Editar Antecedentes Socio/a";
        $this->action = "Update";
        $this->method = "userUpdate";
        $this->cleanError();
        $this->enums = getEnumValues('users', 'calidad');
        $this->showModal = true;
        $this->role = $user->getRoleNames()->toArray() ?? 'None';
    }

    public function userUpdate(): void
    {
        $requestUser = new RequestUser();
        $values = $this->validate($requestUser->rules($this->user), $requestUser->messages());
        $values['rut'] = Rut::parse($values['rut'])->normalize();

        if ($this->passwordComparar != $values['password']){
            $values['password'] = bcrypt($values['password']);
        }

        $this->user->update($values);
        $this->user->syncRoles($values['role']);
        $this->reset();
        $this->alert('success', 'Registro actualizado con éxito!');
        $this->dispatch('UpdateTable');
    }

    #[On('showModalCreate')]
    public function showModalCreateUser(): void
    {
        $this->user = null;
        $this->reset();
        $this->cleanError();
        $this->title = "Ingresar Antecedentes Socio/a";
        $this->action = 'Save all';
        $this->method = "createUser";
        $this->enums = getEnumValues('users', 'calidad');
        $this->showModal = true;
    }

    public function createUser(): void
    {
        $requestUser = new RequestUser();
        $values = $this->validate($requestUser->rules(), $requestUser->messages());
        $values['rut'] = Rut::parse($values['rut'])->normalize();
        $user = new User;
        $user->password = bcrypt($values['rut']);
        $user->fill($values);
        $user->assignRole($values['role']);
        $user->save();
        $user->notify(new MessageNewUser($user));
        $this->reset();
        $this->alert('success', 'Registro creado con éxito!');
        $this->dispatch('UpdateTable');

    }

    public function closeModal(): void
    {
        $this->cleanError();
        $this->reset();
    }

    public function cleanError(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[On('userDelete')]
    public function destroy(User $user): void
    {
        $this->user = $user;
        $this->confirm('¿Desea borrar este registro?', [
            'onConfirmed' => "confirmed"
        ]);
    }

    public function confirmed(): void
    {
        User::find($this->user->id)->delete();
        $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
        $this->dispatch('UpdateTable');
    }

    public function render(): Renderable
    {
        $colecciones = $this->mantenedores();
        $this->roles = Role::pluck('name', 'name')->toArray();
        return view('livewire.users.create', compact('colecciones'));
    }

}

