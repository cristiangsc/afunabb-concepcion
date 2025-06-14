<?php

namespace App\Livewire\Mantenedores\Prevision;

use App\Models\Prevision;
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
    public string $buttonPrevision = '';
    public Prevision $prevision;

    protected $listeners = ['confirmed'];

    #[Rule('required|min:3|unique:previsions,name')]
    public string $name = '';

    public function OpenModalPrevisionCreate(Prevision $prevision = null): void
    {
        $this->name = '';
        $this->resetErrorBag();
        $this->resetValidation();
        if (!empty($prevision->name)) {
            $this->prevision = $prevision;
            $this->name = $prevision->name;
            $this->actionTarget = "updatePrevision";
            $this->title = "Actualizar Tipo de Previsión";
            $this->buttonPrevision = "Update";
        } else {
            $this->actionTarget = "createPrevision";
            $this->title = "Crear nuevo tipo de Previsión";
            $this->buttonPrevision = "Save all";
        }
        $this->OpenCloseModal = !$this->OpenCloseModal;
    }

    public function CloseModal(): void
    {
        $this->OpenCloseModal = false;
    }
    public function updatePrevision(): void
    {
        $this->validate();
        $this->prevision->update(['name' => strtoupper($this->name)]);
        $this->reset();
    }

    public function createPrevision(): void
    {
        $this->validate();
        Prevision::create(['name' => strtoupper($this->name)]);
        $this->reset();
    }

    public function deletePrevision(Prevision $prevision): void
    {
        $this->prevision = $prevision;
        $this->confirm('¿Desea borrar este registro?', [
            'onConfirmed' => "confirmed"
        ]);
    }

    public function confirmed(): void
    {
        try {
            Prevision::find($this->prevision->id)->delete();
            $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
        }catch (\Exception $e)
        {
            $this->alert('warning', 'no es posible eliminar, existen datos asociados a este tipo de Previsión', ['position' => 'bottom-center']);
        }

    }

    public function render(): Renderable
    {
        $previsiones = Prevision::all();

        return view('livewire.mantenedores.prevision.index', compact('previsiones'));
    }
}
