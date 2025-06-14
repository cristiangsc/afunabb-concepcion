<?php

namespace App\Livewire\Contabilidad\Egresos;

use App\Models\Egreso;
use App\Models\EgresosVarios;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert, WithPagination;

    public string $monto = '';
    public int $egreso_id = 0;
    public string $observacion = '';
    public mixed $fecha;
    public string $title = '';
    public string $button = '';
    public bool $showModal = false;
    public int $id;
    public bool $showModalObservacion = false;
    public string $search='';

    public function OpenModalEgresosCreate(): void
    {
        can('egresos create');
        $this->button = 'Save all';
        $this->title = 'Registrar otros egresos';
        $this->observacion = '';
        $this->monto = '';
        $this->fecha = '';
        $this->egreso_id = 0;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->showModal = !$this->showModal;
    }

    public function store():void
    {
        $this->validate([
            'monto' => 'required|min:2',
            'observacion' => 'nullable',
            'fecha' => 'required|date',
            'egreso_id' => 'required'
        ]);

        if ($this->button == 'Update') {
            $egreso = EgresosVarios::find($this->id);
            $egreso->update(...$this->fields());
            $this->alert('success', 'Otros egresos actualizado exitosamente', ['position' => 'bottom-center']);
        } else {
            EgresosVarios::create(...$this->fields());
            $this->alert('success', 'Otros egresos creado exitosamente', ['position' => 'bottom-center']);
        }
        $this->reset();
    }

    private function fields():array
    {
        return array(
            [
                'monto' => num($this->monto),
                'observacion' => $this->observacion,
                'fecha' => $this->fecha,
                'egreso_id' => $this->egreso_id
            ]
        );
    }

    public function OpenModalEgresosEdit(EgresosVarios $egreso):void
    {
        can('egresos update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->title = 'Editar otros Egresos';
        $this->button = 'Update';
        $this->monto = $egreso->monto;
        $this->fecha = date_format(now()->parse($egreso->fecha),"Y-m-d");
        $this->observacion = $egreso->observacion;
        $this->egreso_id = $egreso->egreso_id;
        $this->id = $egreso->id;
        $this->showModal = !$this->showModal;
    }

    public function deleteEgresoVarios(EgresosVarios $egreso): void
    {
        can('egresos delete');
        EgresosVarios::find($egreso->id)->delete();
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
        can('egresos read');
        $egresos = EgresosVarios::with('egreso')->orWhereYear('fecha','like','%' .$this->search . '%' )->orderBy('fecha', 'DESC')->paginate(15);
        $tipo_egresos = Egreso::orderBy('name','ASC')->get();
        return view('livewire.contabilidad.egresos.index', compact('egresos', 'tipo_egresos'));
    }
}
