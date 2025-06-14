<?php

namespace App\Livewire\Contabilidad\Cafeteria\Egresos;

use App\Models\CafeteriaEgreso;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert, WithPagination;

    public string $facturas;
    public string $impuestos;
    public string $comision_junaeb;
    public string $remuneraciones;
    public string $imposiciones;
    public string $honorarios;
    public int $anio;
    public string $mes;
    public string $observaciones = '';
    public string $title = '';
    public string $button = '';
    public bool $showModal = false;
    public int $id;
    public bool $showModalObservacion = false;
    public array $enums;
    public string $search='';

    public function OpenModalEgresosCreate(): void
    {
        can('egresosCafeteria create');
        $this->button = 'Save all';
        $this->title = 'Registrar Egresos Cafeterías';
        $this->observaciones = '';
        $this->anio = date("Y");
        $this->facturas = '';
        $this->impuestos = '';
        $this->comision_junaeb = '';
        $this->remuneraciones = '';
        $this->imposiciones = '';
        $this->honorarios = '';
        $this->mes = '';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->enums = getEnumValues('cafeteria_egresos', 'mes');
        $this->showModal = !$this->showModal;
    }

    public function store():void
    {
        $this->validate([
            'facturas' => 'required|min:1',
            'impuestos' => 'required|min:1',
            'comision_junaeb' => 'required|min:1',
            'remuneraciones' => 'required|min:1',
            'imposiciones' => 'required|min:1',
            'honorarios' => 'required|min:1',
            'observaciones' => 'nullable',
            'mes' => 'required',
            'anio' => 'required|numeric|min:4'
        ]);

        if ($this->button == 'Update') {
            $egresos = CafeteriaEgreso::find($this->id);
            $egresos->update(...$this->fields());
            $this->alert('success', 'Egresos actualizados exitosamente', ['position' => 'bottom-center']);
        } else {
            CafeteriaEgreso::create(...$this->fields());
            $this->alert('success', 'Egresos creados exitosamente', ['position' => 'bottom-center']);
        }
        $this->reset();
    }

    private function fields(): array
    {
        return array(
            [
                'observaciones' => strtoupper($this->observaciones),
                'facturas' => num($this->facturas),
                'impuestos' => num($this->impuestos),
                'comision_junaeb' => num($this->comision_junaeb),
                'remuneraciones' => num($this->remuneraciones),
                'imposiciones' => num($this->imposiciones),
                'honorarios' => num($this->honorarios),
                'mes' => $this->mes,
                'anio' => $this->anio
            ]
        );
    }

    public function OpenModalEgresosEdit(CafeteriaEgreso $egreso):void
    {
        can('egresosCafeteria update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->title = 'Editar Egresos Cafeterías';
        $this->button = 'Update';
        $this->facturas = $egreso->facturas;
        $this->impuestos = $egreso->impuestos;
        $this->comision_junaeb = $egreso->comision_junaeb;
        $this->remuneraciones = $egreso->remuneraciones;
        $this->imposiciones = $egreso->imposiciones;
        $this->honorarios = $egreso->honorarios;
        $this->observaciones = $egreso->observaciones ??  '';
        $this->anio = $egreso->anio;
        $this->mes = $egreso->mes;
        $this->id = $egreso->id;
        $this->showModal = !$this->showModal;
        $this->enums = getEnumValues('cafeteria_egresos', 'mes');
    }

    public function deleteEgresos(CafeteriaEgreso $egreso): void
    {
        can('egresosCafeteria delete');
        CafeteriaEgreso::find($egreso->id)->delete();
        $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
    }

    public function OpenModalObservacion($observaciones): void
    {
        $this->observaciones = $observaciones;
        $this->showModalObservacion = !$this->showModalObservacion;
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): view
    {
        can('egresosCafeteria read');
        $egresos=CafeteriaEgreso::orWhere('anio', 'like','%' .$this->search . '%'  )->orderBy('anio', 'DESC')->paginate(12);
        return view('livewire.contabilidad.cafeteria.egresos.index', compact('egresos'));
    }

}
