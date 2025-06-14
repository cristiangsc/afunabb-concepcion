<?php

namespace App\Livewire\Mantenedores\Reparticion;

use App\Models\Reparticion;
use Illuminate\Contracts\Support\Renderable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;


class Index extends Component
{
    use LivewireAlert, WithPagination;

    public bool $OpenCloseModal = false;
    public string $actionTarget = '';
    public string $title = '';
    public string $buttonReparticion = '';
    public Reparticion $reparticion;
    public string $search = '';
    protected $listeners = ['confirmed'];

    #[Rule('required|min:5|unique:reparticions,name')]
    public string $name = '';

    public function OpenModalReparticionCreate(Reparticion $reparticion = null): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
        if (!empty($reparticion->name)) {
            can('reparticion update');
            $this->reparticion = $reparticion;
            $this->name = $reparticion->name;
            $this->actionTarget = "updateReparticion";
            $this->title = "Actualizar Repartición";
            $this->buttonReparticion = "Update";
        } else {
            can('reparticion create');
            $this->name = '';
            $this->actionTarget = "createReparticion";
            $this->title = "Crear nueva Repartición";
            $this->buttonReparticion = "Save all";
        }
        $this->OpenCloseModal = !$this->OpenCloseModal;
    }

    public function updateReparticion(): void
    {
        $this->validate();
        $this->reparticion->update(['name' => strtoupper($this->name)]);
        $this->reset();
    }

    public function createReparticion(): void
    {
        $this->validate();
        Reparticion::create(['name' => strtoupper($this->name)]);
        $this->reset();
    }

    public function deleteReparticion(Reparticion $reparticion): void
    {
        can('reparticion delete');
        $this->reparticion = $reparticion;
        $this->confirm('¿Desea borrar este registro?', [
            'onConfirmed' => "confirmed"
        ]);
    }

    public function CloseModal(): void
    {
        $this->OpenCloseModal = false;
    }

    public function confirmed(): void
    {
        try {
            Reparticion::find($this->reparticion->id)->delete();
            $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
        }catch (\Exception $e)
        {
            $this->alert('warning', 'no es posible eliminar, existen usuarios asociados a esta repartición', ['position' => 'bottom-center']);
        }

    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): Renderable
    {
        can('reparticion read');
        $reparticiones = Reparticion::orWhere('name','like','%' .$this->search . '%')->orderBy('name','ASC')->paginate(15);
        return view('livewire.mantenedores.reparticion.index', compact('reparticiones'));
    }
}
