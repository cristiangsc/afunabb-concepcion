<?php

namespace App\Livewire\Directorios;

use App\Models\Directorio;
use App\Models\User;
use Freshwork\ChileanBundle\Rut;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;


class Index extends Component
{
    use LivewireAlert, WithPagination;

    public string $cargo = '';
    public string $estado = '';
    public mixed $termino;
    public mixed $inicio;
    public string $rut_id = '';
    public string $title = '';
    public string $button = '';
    public bool $showModal = false;
    public int $id;
    public string $nombres = '';
    public array $enumsCargos = [];
    public array $enumsEstados = [];
    public string $search='';

    public function OpenModalDirectorioCreate(): void
    {
        can('directiva create');
        $this->button = 'Save all';
        $this->title = 'Registrar directorio';
        $this->reset('cargo','rut_id','nombres','inicio','termino','estado');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->enumsEstados = getEnumValues('directorios', 'estado');
        $this->enumsCargos = getEnumValues('directorios', 'cargo');
        $this->showModal = !$this->showModal;
    }

    public function store(): void
    {
        $this->validate([
            'cargo' => 'required',
            'estado' => 'required',
            'inicio' => 'required|date',
            'termino' => 'required|date',
            'rut_id' => 'required',
        ]);

        if ($this->button == 'Update') {
            $directorio = Directorio::find($this->id);
            $directorio->update(...$this->fields());
            $this->alert('success', 'Director/a actualizada exitosamente', ['position' => 'bottom-center']);
        } else {
            Directorio::create(...$this->fields());
            $this->alert('success', 'Director/a creada exitosamente', ['position' => 'bottom-center']);
        }
        $this->reset();
    }

    private function fields(): array
    {
        return array(
            [
                'cargo' => $this->cargo,
                'estado' => $this->estado,
                'inicio' => $this->inicio,
                'rut_id' => Rut::parse($this->rut_id)->normalize(),
                'termino' => $this->termino
            ]
        );
    }

    public function OpenModalDirectorioEdit(Directorio $directorio): void
    {
        can('directiva update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->title = 'Editar Director/a';
        $this->button = 'Update';
        $this->cargo = $directorio->cargo;
        $this->estado = $directorio->estado;
        $this->inicio = formatoFecha($directorio->inicio);
        $this->termino = formatoFecha($directorio->termino);
        $this->id = $directorio->id;
        $this->rut_id = Rut::parse($directorio->rut_id)->format(Rut::FORMAT_COMPLETE);
        $this->nombres = User::where('rut', '=', $directorio->rut_id)->withTrashed()->first()->fullName;
        $this->showModal = !$this->showModal;
        $this->enumsEstados = getEnumValues('directorios', 'estado');
        $this->enumsCargos = getEnumValues('directorios', 'cargo');
    }

    public function deleteDirectorio(Directorio $directorio): void
    {
        can('directiva delete');
        Directorio::find($directorio->id)->delete();
        $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
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
        can('directiva read');
        $directorios = Directorio::with(['user'=> function ($query) {
            $query->withTrashed();
        }])
            ->orWhere('rut_id','like','%' .$this->search . '%')
            ->orderBy('inicio', 'DESC')
            ->orderBy('estado', 'ASC')->paginate(10);

        return view('livewire.directorios.index', compact('directorios'));
    }
}


