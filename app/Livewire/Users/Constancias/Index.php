<?php

namespace App\Livewire\Users\Constancias;

use App\Models\Constancia;
use App\Models\Directorio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

  public string $descripcion = '';
  public bool $showModalDescripcion = false;

    public function OpenModalDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
        $this->showModalDescripcion = !$this->showModalDescripcion;
    }

    public function constanciaPdf(Constancia $constancia)
    {
        can('misConstancias print');
        $presidente = Directorio::with('user')->where('estado','=','Vigente')->where('cargo','=','Presidente(a)')->first();
        $pdf = Pdf::loadView('livewire.constancias.constanciaPdf',compact('constancia','presidente'));
        return $pdf->stream('constancia.pdf');
    }

    public function render(): view
    {
        can('misConstancias read');
        $constancia = Constancia::with('user','reparticion')->orderBy('created_at', 'DESC');
        $constancias = $constancia->where('rut_id','=',Auth::user()->rut)->get();

        return view('livewire.users.constancias.index', compact('constancias'));
    }
}
