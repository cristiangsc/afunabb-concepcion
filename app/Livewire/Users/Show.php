<?php

namespace App\Livewire\Users;


use Illuminate\Contracts\Support\Renderable;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\User;
use App\Traits\GenericTrait;

class Show extends Component
{
    use GenericTrait;

    public bool $showModal = false;
    public string $rut, $nombre, $paterno, $materno, $direccion, $telefono, $password, $num_cuenta, $calidad, $email, $sede, $reparticion, $cargo, $cuenta, $banco, $comuna;
    public $fecha_nacimiento, $fecha_ingreso_ubb, $fecha_ingreso_afunabb, $profile_photo_path,$user;
    public string $title, $action = 'Show';
    #[On('showModalView')]
    public function showModalUser(User $user): void
    {
        $this->rut =rutFormat($user->rut);
        $this->nombre = $user->nombre;
        $this->paterno = $user->paterno;
        $this->materno = $user->materno;
        $this->direccion = $user->direccion;
        $this->telefono = $user->telefono?:'';
        $this->fecha_nacimiento = formatoFecha($user->fecha_nacimiento);
        $this->fecha_ingreso_ubb = formatoFecha($user->fecha_ingreso_ubb);
        $this->fecha_ingreso_afunabb = formatoFecha($user->fecha_ingreso_afunabb);
        $this->num_cuenta = $user->num_cuenta;
        $this->password = $user->password;
        $this->sede = $user->sede->name;
        $this->reparticion = $user->reparticion->name;
        $this->cargo = $user->cargo->name;
        $this->comuna = $user->comuna->name;
        $this->cuenta = $user->cuenta->name;
        $this->calidad = $user->calidad;
        $this->banco = $user->banco->name;
        $this->email = $user->email;
        $this->profile_photo_path = $user->profile_photo_path;
        $this->title ="Antecedentes Personales Socio/a";
        $this->action = "Show";
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->reset();
    }

    public function render():Renderable
    {
        $colecciones = $this->mantenedores();
        return view('livewire.users.show', compact('colecciones'));

    }
}
