<?php

namespace App\Livewire\Constancias;

use App\Models\Constancia;
use App\Models\Directorio;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Freshwork\ChileanBundle\Rut;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;


class Index extends Component
{
    use LivewireAlert, WithPagination;

    public string $descripcion;
    public mixed $inicio;
    public mixed $termino;
    public string $rut_id;
    public string $title = '';
    public string $button = '';
    public bool $showModal = false;
    public int $id;
    public bool $showModalDescripcion = false;
    public string $nombres = '';
    public string $search='';

    public function OpenModalConstanciaCreate(): void
    {
        can('constancias create');
        $this->button = 'Save all';
        $this->title = 'Registrar Constancia';
        $this->descripcion = '';
        $this->nombres = '';
        $this->inicio = '';
        $this->termino = '';
        $this->rut_id = '';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->showModal = !$this->showModal;
    }

    public function store(): void
    {
        $this->validate([
            'descripcion' => 'required|min:10',
            'inicio' => 'required|date',
            'termino' => 'required|date',
            'rut_id' => 'required'
        ]);

        if ($this->button == 'Update') {
            $constancia = Constancia::find($this->id);
            $constancia->update(...$this->fields());
            $this->alert('success', 'Constancia actualizada exitosamente', ['position' => 'bottom-center']);
        } else {
            Constancia::create(...$this->fields());
            $this->alert('success', 'Constancia creada exitosamente', ['position' => 'bottom-center']);
        }
        $this->reset();
    }

    private function fields(): array
    {
        return array(
            [
                'descripcion' => strtoupper($this->descripcion),
                'inicio' => $this->inicio,
                'termino' => $this->termino,
                'rut_id' => Rut::parse($this->rut_id)->normalize()
            ]
        );
    }

    public function OpenModalConstanciaEdit(Constancia $constancia): void
    {
        can('constancias update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->title = 'Editar Constancia';
        $this->button = 'Update';
        $this->descripcion = $constancia->descripcion;
        $this->inicio = formatoFecha($constancia->inicio);
        $this->termino = formatoFecha($constancia->termino);
        $this->rut_id = rutFormat($constancia->rut_id);
        $this->id = $constancia->id;
        $searchRut = User::withTrashed()->where('rut', '=', $constancia->rut_id)->first();
        $this->nombres = $searchRut->fullName;
        $this->showModal = !$this->showModal;

    }

    public function deleteConstancia(Constancia $constancia): void
    {
        can('constancias delete');
        Constancia::find($constancia->id)->delete();
        $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
    }

    public function OpenModalDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
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


    public function imprimirPdfConstancia(Constancia $constancia): ?\Illuminate\Http\Response
    {
        can('constancias print');

        try {
            $presidente = Directorio::with('user')->where('estado', '=', 'Vigente')->where('cargo', '=', 'Presidente(a)')->first();
               $pdf = Pdf::loadView('livewire.constancias.constanciaPdf', compact('constancia', 'presidente'));

               return $pdf->stream('constancia.pdf');
        }catch (\Exception $e)
        {
         $this->alert('warning', '¡No existe registro de presidente/a!', ['position' => 'bottom-center']);
        }
        return null;
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): view
    {
        can('constancias read');
        $constancias = Constancia::with(['user'=> function ($query){
            $query->withTrashed()->with('reparticion');
        }])->orWhere('rut_id', 'like', '%' . $this->search . '%')->orderBy('created_at', 'DESC')->paginate(10);


        return view('livewire.constancias.index', compact('constancias'));
    }
}
