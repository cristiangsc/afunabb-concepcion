<?php

namespace App\Livewire\Contabilidad\Cafeteria\Ingresos;

use App\Models\CafeteriaIngreso;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert, WithPagination;

    public string $caja;
    public string $transbank;
    public string $junaeb;
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


    public function OpenModalIngresosCreate(): void
    {
        can('ingresosCafeteria create');
        $this->button = 'Save all';
        $this->title = 'Registrar Ingresos Cafeterías';
        $this->observaciones = '';
        $this->anio = date("Y");
        $this->junaeb = '';
        $this->transbank = '';
        $this->caja = '';
        $this->mes = '';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->enums = getEnumValues('cafeteria_ingresos', 'mes');
        $this->showModal = !$this->showModal;
    }

    public function store():void
    {
        $this->validate([
            'caja' => 'required|min:1',
            'transbank' => 'required|min:1',
            'junaeb' => 'required|min:1',
            'observaciones' => 'nullable',
            'mes' => 'required',
            'anio' => 'required|numeric|min:4'
        ]);

        if ($this->button == 'Update') {
            $ingresos = CafeteriaIngreso::find($this->id);
            $ingresos->update(...$this->fields());
            $this->alert('success', 'Ingresos actualizados exitosamente', ['position' => 'bottom-center']);
        } else {

            CafeteriaIngreso::create(...$this->fields());
            $this->alert('success', 'Ingresos creados exitosamente', ['position' => 'bottom-center']);
        }
        $this->reset();
    }

    private function fields(): array
    {
        return array(
            [
                'observaciones' => strtoupper($this->observaciones),
                'caja' => num($this->caja),
                'transbank' => num($this->transbank),
                'junaeb' => num($this->junaeb),
                'mes' => $this->mes,
                'anio' => $this->anio
            ]
        );
    }

    public function OpenModalIngresosEdit(CafeteriaIngreso $ingreso):void
    {
        can('ingresosCafeteria update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->title = 'Editar Ingresos Cafeterías';
        $this->button = 'Update';
        $this->caja = $ingreso->caja;
        $this->transbank = $ingreso->transbank;
        $this->observaciones = $ingreso->observaciones ??  '';
        $this->junaeb = $ingreso->junaeb;
        $this->anio = $ingreso->anio;
        $this->mes = $ingreso->mes;
        $this->id = $ingreso->id;
        $this->showModal = !$this->showModal;
        $this->enums = getEnumValues('cafeteria_ingresos', 'mes');
    }

    public function deleteIngresos(CafeteriaIngreso $ingreso): void
    {
        can('ingresosCafeteria delete');
        CafeteriaIngreso::find($ingreso->id)->delete();
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
        can('ingresosCafeteria read');
        $ingresos=CafeteriaIngreso::orWhere('anio', 'like','%' .$this->search . '%'  )->orderBy('anio', 'DESC')->paginate(12);
        return view('livewire.contabilidad.cafeteria.ingresos.index', compact('ingresos'));
    }
}

