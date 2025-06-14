<?php

namespace App\Livewire\Mantenedores\Cuenta;

use App\Models\Cuenta;
use Illuminate\Contracts\Support\Renderable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Index extends Component
{
    use LivewireAlert;

    public bool $OpenCloseModal = false;
    public string $actionTarget = '';
    public string $title = '';
    public string $buttonCuenta = '';
    public Cuenta $cuenta;

    protected $listeners = ['confirmed'];

    #[Rule('required|min:5|unique:cuentas,name')]
    public string $name = '';

    public function OpenModalCuentaCreate(Cuenta $cuenta = null): void
    {
        $this->name = '';
        $this->resetErrorBag();
        $this->resetValidation();
        if (!empty($cuenta->name)) {
            can('cuentas update');
            $this->cuenta = $cuenta;
            $this->name = $cuenta->name;
            $this->actionTarget = "updateCuenta";
            $this->title = "Actualizar Cuenta";
            $this->buttonCuenta = "Update";
        } else {
            can('cuentas create');
            $this->actionTarget = "createCuenta";
            $this->title = "Crear nueva Cuenta";
            $this->buttonCuenta = "Save all";
        }
        $this->OpenCloseModal = !$this->OpenCloseModal;
    }

    public function updateCuenta(): void
    {
        $this->validate();
        $this->cuenta->update(['name' => strtoupper($this->name)]);
        $this->reset();
    }

    public function createCuenta(): void
    {
        $this->validate();
        Cuenta::create(['name' => strtoupper($this->name)]);
        $this->reset();
    }
    public function CloseModal(): void
    {
        $this->OpenCloseModal = false;
    }

    public function deleteCuenta(Cuenta $cuenta): void
    {
        can('cuentas delete');
        $this->cuenta = $cuenta;
        $this->confirm('¿Desea borrar este registro?', [
            'onConfirmed' => "confirmed"
        ]);
    }

    public function confirmed(): void
    {
        try {
            Cuenta::find($this->cuenta->id)->delete();
            $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
        }catch (\Exception $e)
        {
            $this->alert('warning', 'no es posible eliminar, existen usuarios asociados a esta cuenta', ['position' => 'bottom-center']);
        }
    }

    public function render(): Renderable
    {
        can('cuentas read');
        $cuentas = Cuenta::all();
        return view('livewire.mantenedores.cuenta.index', compact('cuentas'));
    }
}
