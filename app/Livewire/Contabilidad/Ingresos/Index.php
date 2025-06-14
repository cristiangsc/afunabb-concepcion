<?php

namespace App\Livewire\Contabilidad\Ingresos;

use App\Models\Ingreso;
use App\Models\IngresosVarios;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert, WithPagination;

    public string $monto = '';
    public int $ingreso_id = 0;
    public string $observacion = '';
    public mixed $fecha;
    public string $title = '';
    public string $button = '';
    public bool $showModal = false;
    public int $id;
    public bool $showModalObservacion = false;
    public string $search='';

    public function OpenModalIngresosCreate(): void
    {
        can('ingresos create');
        $this->button = 'Save all';
        $this->title = 'Registrar otros ingresos';
        $this->observacion = '';
        $this->monto = '';
        $this->fecha = '';
        $this->ingreso_id = 0;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->showModal = !$this->showModal;
    }

    public function store()
    {
        $this->validate([
            'monto' => 'required|min:2',
            'observacion' => 'nullable',
            'fecha' => 'required|date',
            'ingreso_id' => 'required'
        ]);

        if ($this->button == 'Update') {
            $ingreso = IngresosVarios::find($this->id);
            $ingreso->update(...$this->fields());
            $this->alert('success', 'Otros ingresos actualizado exitosamente', ['position' => 'bottom-center']);
        } else {

            IngresosVarios::create(...$this->fields());
            $this->alert('success', 'Otros ingresos creado exitosamente', ['position' => 'bottom-center']);
        }
        $this->reset();
    }

    private function fields():array
    {
        return array([
            'monto' => num($this->monto),
            'observacion' => $this->observacion,
            'fecha' => $this->fecha,
            'ingreso_id' => $this->ingreso_id
        ]);
    }

    public function OpenModalIngresosEdit(IngresosVarios $ingreso): void
    {
        can('ingresos update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->title = 'Editar otros Ingresos';
        $this->button = 'Update';
        $this->monto = $ingreso->monto;
        $this->fecha = formatoFecha($ingreso->fecha);
        $this->observacion = $ingreso->observacion;
        $this->ingreso_id = $ingreso->ingreso_id;
        $this->id = $ingreso->id;
        $this->showModal = !$this->showModal;
    }

    public function deleteIngresoVarios(IngresosVarios $ingreso): void
    {
        can('ingresos delete');
        IngresosVarios::find($ingreso->id)->delete();
        $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
    }

    public function OpenModalObservacion($observacion): void
    {
        $this->observacion = $observacion;
        $this->showModalObservacion = !$this->showModalObservacion;
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): view
    {
        can('ingresos read');
        $ingresos = IngresosVarios::with('ingreso')->orWhereYear('fecha','like','%' .$this->search . '%' )->orderBy('fecha', 'DESC')->paginate();
        $tipo_ingresos = Ingreso::orderBy('name','ASC')->get();
        return view('livewire.contabilidad.ingresos.index', compact('ingresos', 'tipo_ingresos'));
    }
}
