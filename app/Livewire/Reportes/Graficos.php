<?php

namespace App\Livewire\Reportes;


use Illuminate\View\View;
use Livewire\Component;

class Graficos extends Component
{

    public array $anios = [];

    public function mount(): void
    {
        $anio = date('Y');
        $maximo = $anio -2018;
        for ($i = 0; $i <= $maximo; $i++) {
            $this->anios[] = $anio - $i;
        }
    }

    public function render(): view
    {
        can('graficos');
        return view('livewire.reportes.graficos')    ;
    }
}
