<?php

namespace App\Livewire\Mantenedores\Cargo;

use App\Models\Cargo;
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
    public string $buttonCargo = '';
    public Cargo $cargo;

    protected $listeners = ['confirmed'];

    #[Rule('required|min:5|unique:comunas,name')]
    public string $name = '';

    public function OpenModalCargoCreate(Cargo $cargo = null): void
    {
        $this->name = '';
        $this->resetErrorBag();
        $this->resetValidation();
        if (!empty($cargo->name)) {
            can('cargos update');
            $this->cargo = $cargo;
            $this->name = $cargo->name;
            $this->actionTarget = "updateCargo";
            $this->title = "Actualizar Cargo";
            $this->buttonCargo = "Update";
        } else {
            can('cargos create');
            $this->actionTarget = "createCargo";
            $this->title = "Crear nuevo Cargo";
            $this->buttonCargo = "Save all";
        }
        $this->OpenCloseModal = !$this->OpenCloseModal;
    }

    public function updateCargo(): void
    {
        $this->validate();
        $this->cargo->update(['name' => strtoupper($this->name)]);
        $this->reset();
    }

    public function createCargo(): void
    {
        $this->validate();
        Cargo::create(['name' => strtoupper($this->name)]);
        $this->reset();
    }

    public function CloseModal(): void
    {
        $this->OpenCloseModal = false;
    }

    public function deleteCargo(Cargo $cargo): void
    {
        can('cargos delete');
        $this->cargo = $cargo;
        $this->confirm('¿Desea borrar este registro?', [
            'onConfirmed' => "confirmed"
        ]);
    }

    public function confirmed(): void
    {
        try {
            Cargo::find($this->cargo->id)->delete();
            $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
        }catch (\Exception $e)
        {
            $this->alert('warning', 'no es posible eliminar, existen usuarios asociados a este cargo', ['position' => 'bottom-center']);
        }
    }

    public function render(): Renderable
    {
        can('cargos read');
        $cargos = Cargo::all();
        return view('livewire.mantenedores.cargo.index', compact('cargos'));
    }
}
