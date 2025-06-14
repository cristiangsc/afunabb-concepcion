<?php

namespace App\Livewire\Mantenedores\Comuna;

use App\Models\Comuna;
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
    public string $buttonComuna = '';
    public Comuna $comuna;

    protected $listeners = ['confirmed'];

    #[Rule('required|min:5')]
    public string $name = '';

    #[Rule('required|min:5')]
    public string $region = '';

    #[Rule('required|integer|min:1')]
    public int $cod_region = 0;

    public function OpenModalComunaCreate(Comuna $comuna = null): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
        if (!empty($comuna->name)) {
            can('comunas update');
            $this->comuna = $comuna;
            $this->name = $comuna->name;
            $this->region = $comuna->region;
            $this->cod_region = $comuna->cod_region;
            $this->actionTarget = "updateComuna";
            $this->title = "Actualizar Comuna";
            $this->buttonComuna = "Update";
        } else {
            can('comunas create');
            $this->name = '';
            $this->region = '';
            $this->cod_region = 0;
            $this->actionTarget = "createComuna";
            $this->title = "Crear nueva Comuna";
            $this->buttonComuna = "Save all";
        }
        $this->OpenCloseModal = !$this->OpenCloseModal;
    }

    public function updateComuna(): void
    {
        $this->validate();
        $this->comuna->update(['name' => strtoupper($this->name),'region' => strtoupper($this->region),'cod_region' => strtoupper($this->cod_region)]);
        $this->reset();
    }

    public function createComuna(): void
    {
        $this->validate();
        Comuna::create(['name' => strtoupper($this->name),'region' => strtoupper($this->region),'cod_region' => strtoupper($this->cod_region)]);
        $this->reset();
    }

    public function deleteComuna(Comuna $comuna): void
    {
        can('comunas delete');
        $this->comuna = $comuna;
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
            Comuna::find($this->comuna->id)->delete();
            $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
        }catch (\Exception $e)
        {
            $this->alert('warning', 'no es posible eliminar, existen usuarios asociados a esta comuna', ['position' => 'bottom-center']);
        }

    }

    public function render(): Renderable
    {
        can('comunas read');
        $comunas = Comuna::orderBy('name','ASC')->paginate(15);
        return view('livewire.mantenedores.comuna.index', compact('comunas'));
    }
}
