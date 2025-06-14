<?php

namespace App\Livewire\Mantenedores\Sede;

use App\Models\Sede;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Attributes\Rule;
use Livewire\Component;
use \Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;

    public bool $OpenCloseModal = false;
    public string $actionTarget = '';
    public string $title = '';
    public string $buttonSede = '';
    public Sede $sede;

    protected $listeners = ['confirmed'];

    #[Rule('required|min:5|unique:sedes,name')]
    public string $name = '';

    public function OpenModalSedeCreate(Sede $sede = null): void
    {
        $this->name = '';
        $this->resetErrorBag();
        $this->resetValidation();
        if (!empty($sede->name)) {
            can('sedes update');
            $this->sede = $sede;
            $this->name = $sede->name;
            $this->actionTarget = "updateSede";
            $this->title = "Actualizar Sede";
            $this->buttonSede = "Update";
        } else {
            can('sedes create');
            $this->actionTarget = "createSede";
            $this->title = "Crear nueva Sede";
            $this->buttonSede = "Save all";
        }
        $this->OpenCloseModal = !$this->OpenCloseModal;
    }

    public function CloseModal(): void
    {
        $this->OpenCloseModal = false;
    }
    public function updateSede(): void
    {
        $this->validate();
        $this->sede->update(['name' => strtoupper($this->name)]);
        $this->reset();
    }

    public function createSede(): void
    {
        $this->validate();
        Sede::create(['name' => strtoupper($this->name)]);
        $this->reset();
    }

    public function deleteSede(Sede $sede): void
    {
        can('sedes delete');
        $this->sede = $sede;
        $this->confirm('¿Desea borrar este registro?', [
            'onConfirmed' => "confirmed"
        ]);
    }

    public function confirmed(): void
    {
        try {
            Sede::find($this->sede->id)->delete();
            $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
        }catch (\Exception $e)
        {
            $this->alert('warning', 'no es posible eliminar, existen usuarios asociados a esta sede', ['position' => 'bottom-center']);
        }

    }

    public function render(): Renderable
    {
        can('sedes read');
        $sedes = Sede::all();
        return view('livewire.mantenedores.sede.index', compact('sedes'));
    }
}
