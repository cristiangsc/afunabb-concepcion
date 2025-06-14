<?php

namespace App\Livewire\Contabilidad\Inversiones;

use App\Models\Inversion;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert, WithPagination;

    public string $monto = '';
    public string $descripcion = '';
    public string $observacion = '';
    public string $documento = '';
    public string $tipo = '';
    public int $num_documento;
    public mixed $fecha;
    public string $title = '';
    public string $button = '';
    public bool $showModal = false;
    public int $id;
    public bool $showModalObservacion = false;
    public array $enums_tipo;
    public array $enums_documento;
    public string $search='';

    public function OpenModalInversionCreate(): void
    {
        can('inversiones create');
        $this->button = 'Save all';
        $this->title = 'Registrar otra inversión';
        $this->observacion = '';
        $this->descripcion = '';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->enums_tipo = getEnumValues('inversions', 'tipo');
        $this->enums_documento = getEnumValues('inversions', 'documento');
        $this->showModal = !$this->showModal;
    }

    public function store():void
    {
        $this->validate([
            'descripcion' => 'required|min:5',
            'observacion' => 'nullable',
            'fecha' => 'required|date',
            'documento' => 'required',
            'tipo' => 'required',
            'num_documento' => 'required|numeric|min:1',
            'monto' => 'required|numeric'
        ]);

        if ($this->button == 'Update') {
            $inversion = Inversion::find($this->id);
            $inversion->update(...$this->fields());
            $this->alert('success', 'Inversión actualizada exitosamente', ['position' => 'bottom-center']);
        } else {
            Inversion::create(...$this->fields());
            $this->alert('success', 'Inversión creada exitosamente', ['position' => 'bottom-center']);
        }
        $this->reset();
    }

    private function fields(): array
    {
        return array(
            [
                'descripcion' => strtoupper($this->descripcion),
                'observacion' => strtoupper($this->observacion),
                'fecha' => $this->fecha,
                'documento' => $this->documento,
                'tipo' => $this->tipo,
                'num_documento' => $this->num_documento,
                'monto' => num($this->monto)
            ]
        );
    }

    public function OpenModalInversionEdit(Inversion $inversion):void
    {
        can('inversiones update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->title = 'Editar Inversión';
        $this->button = 'Update';
        $this->monto = $inversion->monto;
        $this->fecha = date_format(now()->parse($inversion->fecha),"Y-m-d");
        $this->observacion = $inversion->observacion ??  '';
        $this->documento = $inversion->documento;
        $this->tipo = $inversion->tipo;
        $this->num_documento = $inversion->num_documento;
        $this->descripcion = $inversion->descripcion;
        $this->id = $inversion->id;
        $this->showModal = !$this->showModal;
        $this->enums_tipo = getEnumValues('inversions', 'tipo');
        $this->enums_documento = getEnumValues('inversions', 'documento');
    }

    public function deleteInversionVarios(Inversion $inversion): void
    {
        can('inversiones delete');
        Inversion::find($inversion->id)->delete();
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
        can('inversiones read');
        $inversiones = Inversion::orWhereYear('fecha','like','%' .$this->search . '%' )->orderBy('fecha', 'DESC')->paginate();
        return view('livewire.contabilidad.inversiones.index', compact('inversiones'));
    }
}
