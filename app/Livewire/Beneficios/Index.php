<?php

namespace App\Livewire\Beneficios;

use App\Http\Requests\RequestCreateBenefit;
use App\Models\Benefit;
use Illuminate\Contracts\Support\Renderable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert, WithPagination;

    public bool $showModal = false;
    public string $name = '';
    public $fecha;
    public bool $vigencia = false;
    public bool $update = false;
    public Benefit $benefit;
    public string $search='';

    public function OpenModalBeneficioCreate(Benefit $benefit = null): void
    {
        can('beneficios create');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset('name', 'fecha', 'vigencia', 'update');
        if (!empty($benefit->name)) {
            can('beneficios update');
            $this->name = $benefit->name;
            $this->fecha = formatoFecha($benefit->fecha);
            $this->vigencia = $benefit->vigencia;
            $this->update = true;
            $this->benefit = $benefit;
        }
        $this->showModal = !$this->showModal;
    }

    public function createBenefict(): void
    {
        $request = new RequestCreateBenefit;

        if ($this->update) {
            $this->alert('info', '¡El registro ha sido actualizado con éxito!', ['position' => 'bottom-center']);
            $values = $this->validate($request->rules($this->benefit), $request->messages());
            $this->benefit->update($this->assignValues($values));
        } else {
            $values = $this->validate($request->rules(), $request->messages());
            Benefit::create($this->assignValues($values));
            $this->alert('info', '¡El registro ha sido creado con éxito!', ['position' => 'bottom-center']);
        }
        $this->reset('name', 'fecha', 'vigencia', 'update');
    }

    public function deleteBeneficio(Benefit $benefit): void
    {
        can('beneficios delete');
        Benefit::find($benefit->id)->delete();
        $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): Renderable
    {
        can('beneficios read');
        $benefits = Benefit::orWhere('name','like','%' .$this->search . '%')->orderBy('vigencia', 'DESC')->orderBy('fecha', 'DESC')->paginate(10);
        return view('livewire.beneficios.index', compact('benefits'));
    }

    protected function assignValues($values): array
    {
        return [
            'name' => strtoupper($values['name']),
            'fecha' => $values['fecha'],
            'vigencia' => $values['vigencia']
        ];
    }
}
