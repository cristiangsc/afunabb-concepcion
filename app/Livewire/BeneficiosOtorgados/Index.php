<?php

namespace App\Livewire\BeneficiosOtorgados;

use App\Models\BeneficioSocio;
use App\Models\Benefit;
use App\Models\User;
use Freshwork\ChileanBundle\Rut;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;


class Index extends Component
{
    use LivewireAlert, WithPagination;

    public string $observacion = '';
    public mixed $fecha_asignacion;
    public string $rut_id = '';
    public string $title = '';
    public string $button = '';
    public bool $showModal = false;
    public int $id;
    public string $monto = '';
    public int $benefit_id;
    public bool $showModalDescripcion = false;
    public string $nombres = '';
    public string $search='';

    public function OpenModalBeneficioAsignadoCreate(): void
    {
        can('beneficiosOtorgados create');
        $this->button = 'Save all';
        $this->title = 'Registrar Asignación de Beneficio';
        $this->reset('observacion','rut_id','benefit_id','nombres','fecha_asignacion','monto');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->showModal = !$this->showModal;
    }

    public function store(): void
    {
        $this->validate([
            'observacion' => 'nullable|min:10',
            'monto' => 'required|min:2',
            'benefit_id' => 'required',
            'rut_id' => 'required',
            'fecha_asignacion' => 'required|date'
        ]);

        if ($this->button == 'Update') {
            $beneficios = BeneficioSocio::find($this->id);
            $beneficios->update(...$this->fields());
            $this->alert('success', 'Asignación de Beneficios actualizada exitosamente', ['position' => 'bottom-center']);
        } else {
            BeneficioSocio::create(...$this->fields());
            $this->alert('success', 'Asignación de Beneficios creada exitosamente', ['position' => 'bottom-center']);
        }
        $this->reset();
    }

    private function fields(): array
    {
        return array(
            [
                'observacion' => strtoupper($this->observacion),
                'monto' => num($this->monto),
                'benefit_id' => $this->benefit_id,
                'rut_id' => Rut::parse($this->rut_id)->normalize(),
                'fecha_asignacion' => $this->fecha_asignacion,
            ]
        );
    }

    public function OpenModalBeneficioAsignacionEdit(BeneficioSocio $beneficioSocio): void
    {
        can('beneficiosOtorgados update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->title = 'Editar Asignación de Beneficio';
        $this->button = 'Update';
        $this->observacion = $beneficioSocio->observacion;
        $this->monto = $beneficioSocio->monto;
        $this->benefit_id = $beneficioSocio->benefit_id;
        $this->fecha_asignacion = formatoFecha($beneficioSocio->fecha_asignacion);
        $this->id = $beneficioSocio->id;
        $this->rut_id = Rut::parse($beneficioSocio->rut_id)->format(Rut::FORMAT_COMPLETE);
        $this->nombres = User::where('rut', '=', $beneficioSocio->rut_id)->withTrashed()->first()->fullName;
        $this->showModal = !$this->showModal;
    }

    public function deleteBeneficioAsignacion(BeneficioSocio $beneficioSocio): void
    {
        can('beneficiosOtorgados delete');
        BeneficioSocio::find($beneficioSocio->id)->delete();
        $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
    }

    public function OpenModalDescripcion($descripcion): void
    {
        $this->observacion = $descripcion;
        $this->showModalDescripcion = !$this->showModalDescripcion;
    }

    public function searchUser(): void
    {
        if (!empty($this->rut_id)) {
            $rut = (new Rut($this->rut_id))->quiet()->validate();

            if (!$rut) {
                $rut = Rut::parse($this->rut_id)->quiet()->normalize();
                $searchRut = User::where('rut', '=', $rut)->first();

                if (!empty($searchRut)) {
                    $this->nombres = $searchRut->fullName;
                    $this->rut_id = Rut::parse($searchRut->rut)->format(Rut::FORMAT_COMPLETE);
                } else {
                    $this->reset('rut_id');
                    $this->alert('warning', '¡El rut ingresado no se encuentra en la BD!', ['position' => 'bottom-center']);
                }
            } else {
                $this->alert('warning', '¡El rut ingresado no es correcto!', ['position' => 'bottom-center']);
            }
        } else {
            $this->alert('warning', '¡Debe ingresar un rut!', ['position' => 'bottom-center']);
        }
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): view
    {
        can('beneficiosOtorgados read');
        $beneficios = BeneficioSocio::with(['user'=> function ($query) {
            $query->withTrashed()->with('reparticion');
        }])
        ->with('beneficio')
        ->orWhere('rut_id', 'like', '%' . $this->search . '%')
        ->orderBy('created_at', 'DESC')->paginate(10);
        $selectBeneficios = Benefit::orderBy('name','DESC')->get();
        return view('livewire.beneficios-otorgados.index', compact('beneficios','selectBeneficios'));
    }
}

