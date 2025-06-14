<?php

namespace App\Livewire\Users\Beneficios;

use App\Models\BeneficioSocio;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;


class Index extends Component
{
    public string $observacion = '';
    public bool $showModalDescripcion = false;

    public function OpenModalDescripcion($descripcion): void
    {
        $this->observacion = $descripcion;
        $this->showModalDescripcion = !$this->showModalDescripcion;
    }

    public function render(): view
    {
        can('misBeneficios read');
        $beneficio = BeneficioSocio::with('user','reparticion','beneficio')->orderBy('created_at', 'DESC');
        $beneficios = $beneficio->where('rut_id','=',Auth::user()->rut)->get();
        return view('livewire.users.beneficios.index', compact('beneficios'));
    }
}


