<?php

namespace App\Livewire\Mantenedores\Ingresos;

use App\Models\Ingreso;
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
    public string $buttonIngreso = '';
    public Ingreso $ingreso;
    public string $search = '';
    protected $listeners = ['confirmed'];

    #[Rule('required|min:5|unique:ingresos,name')]
    public string $name = '';

    public function OpenModalIngresoCreate(Ingreso $ingreso = null): void
    {

        $this->resetErrorBag();
        $this->resetValidation();
        if (!empty($ingreso->name)) {
            can('ingresosTipos update');
            $this->ingreso = $ingreso;
            $this->name = $ingreso->name;
            $this->actionTarget = "updateIngreso";
            $this->title = "Actualizar Tipo de Ingreso";
            $this->buttonIngreso = "Update";
        } else {
            can('ingresosTipos create');
            $this->name = '';
            $this->actionTarget = "createIngreso";
            $this->title = "Crear nuevo tipo de Ingreso";
            $this->buttonIngreso = "Save all";
        }
        $this->OpenCloseModal = !$this->OpenCloseModal;
    }

    public function CloseModal(): void
    {
        $this->OpenCloseModal = false;
    }
    public function updateIngreso(): void
    {
        $this->validate();
        $this->ingreso->update(['name' => strtoupper($this->name)]);
        $this->reset();
    }

    public function createIngreso(): void
    {
        $this->validate();
        Ingreso::create(['name' => strtoupper($this->name)]);
        $this->reset();
    }

    public function deleteIngreso(Ingreso $ingreso): void
    {
        can('ingresosTipos delete');
        $this->ingreso = $ingreso;
        $this->confirm('¿Desea borrar este registro?', [
            'onConfirmed' => "confirmed"
        ]);
    }

    public function confirmed(): void
    {
        try {
            Ingreso::find($this->ingreso->id)->delete();
            $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
        }catch (\Exception $e)
        {
            $this->alert('warning', 'no es posible eliminar, existen datos asociados a este tipo de Ingreso', ['position' => 'bottom-center']);
        }

    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): Renderable
    {
        can('ingresosTipos read');
        $ingresos = Ingreso::orWhere('name','like','%' .$this->search . '%')->orderBy('name','ASC')->paginate(10);
        return view('livewire.mantenedores.ingresos.index', compact('ingresos'));
    }
}
