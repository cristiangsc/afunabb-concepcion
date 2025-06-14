<?php

namespace App\Livewire\Mantenedores\Egresos;

use App\Models\Egreso;
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
    public string $buttonEgreso = '';
    public Egreso $egreso;
    public string $search = '';
    protected $listeners = ['confirmed'];

    #[Rule('required|min:5|unique:egresos,name')]
    public string $name = '';

    public function OpenModalEgresoCreate(Egreso $egreso = null): void
    {

        $this->resetErrorBag();
        $this->resetValidation();
        if (!empty($egreso->name)) {
            can('egresosTipos update');
            $this->egreso = $egreso;
            $this->name = $egreso->name;
            $this->actionTarget = "updateEgreso";
            $this->title = "Actualizar Egreso";
            $this->buttonEgreso = "Update";
        } else {
            can('egresosTipos create');
            $this->name = '';
            $this->actionTarget = "createEgreso";
            $this->title = "Crear nuevo tipo de Egreso";
            $this->buttonEgreso = "Save all";
        }
        $this->OpenCloseModal = !$this->OpenCloseModal;
    }

    public function CloseModal(): void
    {
        $this->OpenCloseModal = false;
    }
    public function updateEgreso(): void
    {
        $this->validate();
        $this->egreso->update(['name' => strtoupper($this->name)]);
        $this->reset();
    }

    public function createEgreso(): void
    {
        $this->validate();
        Egreso::create(['name' => strtoupper($this->name)]);
        $this->reset();
    }

    public function deleteEgreso(Egreso $egreso): void
    {
        can('egresosTipos delete');
        $this->egreso = $egreso;
        $this->confirm('¿Desea borrar este registro?', [
            'onConfirmed' => "confirmed"
        ]);
    }

    public function confirmed(): void
    {
        try {
            Egreso::find($this->egreso->id)->delete();
            $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
        }catch (\Exception $e)
        {
            $this->alert('warning', 'no es posible eliminar, existen datos asociados a este tipo de Egreso ', ['position' => 'bottom-center']);
        }

    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }
    public function render(): Renderable
    {
        can('egresosTipos read');
        $egresos  = Egreso::orWhere('name','like','%' .$this->search . '%')->orderBy('name','ASC')->paginate(10);;
        return view('livewire.mantenedores.egresos.index', compact('egresos'));
    }
}
