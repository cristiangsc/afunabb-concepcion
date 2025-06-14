<?php

namespace App\Livewire\Mantenedores\Banco;

use App\Models\Banco;
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
    public string $buttonBanco = '';
    public Banco $banco;

    protected $listeners = ['confirmed'];

    #[Rule('required|min:5|unique:bancos,name')]
    public string $name = '';

    public function OpenModalBancoCreate(Banco $banco = null): void
    {
        $this->name = '';
        $this->resetErrorBag();
        $this->resetValidation();
        if (!empty($banco->name)) {
            can('bancos update');
            $this->banco = $banco;
            $this->name = $banco->name;
            $this->actionTarget = "updateBanco";
            $this->title = "Actualizar Banco";
            $this->buttonBanco = "Update";
        } else {
            can('bancos create');
            $this->actionTarget = "createBanco";
            $this->title = "Crear nuevo Banco";
            $this->buttonBanco = "Save all";
        }
        $this->OpenCloseModal = !$this->OpenCloseModal;
    }

    public function CloseModal(): void
    {
        $this->OpenCloseModal = false;
    }

    public function updateBanco(): void
    {
        $this->validate();
        $this->banco->update(['name' => strtoupper($this->name)]);
        $this->reset();
    }

    public function createBanco(): void
    {
        $this->validate();
        Banco::create(['name' => strtoupper($this->name)]);
        $this->reset();
    }

    public function deleteBanco(Banco $banco): void
    {
        can('bancos delete');
        $this->banco = $banco;
        $this->confirm('¿Desea borrar este registro?', [
            'onConfirmed' => "confirmed"
        ]);
    }

    public function confirmed(): void
    {
        try {
            Banco::find($this->banco->id)->delete();
            $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
        }catch (\Exception $e)
        {
            $this->alert('warning', 'no es posible eliminar, existen usuarios asociados a este banco', ['position' => 'bottom-center']);
        }
    }

    public function render(): Renderable
    {
        can('bancos read');
        $bancos = Banco::orderBy('name','ASC')->paginate(10);
        return view('livewire.mantenedores.banco.index', compact('bancos'));
    }
}
