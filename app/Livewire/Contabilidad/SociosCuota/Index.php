<?php

namespace App\Livewire\Contabilidad\SociosCuota;


use App\Models\Aporte;
use App\Models\Sede;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert, WithPagination;

    public int $socios = 0;
    public string $monto = '';
    public int $anio = 0;
    public string $mes = '';
    public mixed $fecha;
    public int $user_id = 0;
    public int $sede_id = 0;
    public string $sort = 'fecha';
    public string $direction = 'desc';
    public bool $showModal = false;
    public string $title ='';
    public string $search='';
    protected array $queryString = [
        'sort' => ['except' => 'title'],
        'direction' => ['except' => 'asc']
    ];
    public array $enums;
    public string $button = '';
    public int $id;

    public function order($sort): void
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function store(): void
    {
        $this->validate([
            'socios' => 'required|numeric',
            'monto' => 'required|numeric',
            'anio' => 'required|numeric',
            'mes' => 'required',
            'fecha' => 'required|date',
            'sede_id' => 'required'
        ]);

        if ($this->button == 'Update') {
            $aporte = Aporte::find($this->id);
            $aporte->update($this->fields());
            $this->alert('success', 'Aporte actualizado exitosamente', ['position' => 'bottom-center']);
        } else {

            Aporte::create($this->fields());
            $this->alert('success', 'Aporte creado exitosamente', ['position' => 'bottom-center']);
        }
        $this->reset();
    }

    private function fields():array
    {
        return [
            'socios' => $this->socios,
            'monto' => num($this->monto),
            'mes' => $this->mes,
            'anio' => $this->anio,
            'fecha' => date_format(now()->parse($this->fecha),"Y-m-d"),
            'sede_id' => $this->sede_id
        ];
    }

    public function deleteAporte(Aporte $aporte): void
    {
        can('aportes delete');
        Aporte::find($aporte->id)->delete();
        $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
    }

    public function OpenModalAporteCreate(): void
    {
        can('aportes create');
        $this->button = 'Save all';
        $this->title = 'Registrar cuota socio/a';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->enums = getEnumValues('aportes', 'mes');
        $this->anio = date("Y");
        $this->monto = '';
        $this->mes ='';
        $this->socios = 0;
        $this->fecha = '';
        $this->showModal = !$this->showModal;
    }

    public function OpenModalAporteEdit(Aporte $aporte): void
    {
        can('aportes update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->enums = getEnumValues('aportes', 'mes');
        $this->title = 'Modificar cuota socio/a';
        $this->button = 'Update';
        $this->anio = $aporte->anio;
        $this->socios = $aporte->socios;
        $this->monto = $aporte->monto;
        $this->fecha = date_format(now()->parse($aporte->fecha),"Y-m-d");
        $this->mes = $aporte->mes;
        $this->sede_id = $aporte->sede_id;
        $this->id = $aporte->id;
        $this->showModal = !$this->showModal;
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): view
    {
        can('aportes read');
        $aportes = Aporte::with('sede')->orWhere('anio','like','%' .$this->search . '%')->orderBy($this->sort, $this->direction)->paginate();
        $sedes = Sede::all();
        return view('livewire.contabilidad.socios-cuota.index', compact('aportes', 'sedes'));
    }
}
