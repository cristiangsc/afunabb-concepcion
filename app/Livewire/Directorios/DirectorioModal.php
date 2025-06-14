<?php

namespace App\Livewire\Directorios;

use App\Models\Directorio;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class DirectorioModal extends Component
{
    public bool $open = false;
    public string $title = '';

    public function render():Renderable
    {
        $directorios = Directorio::with(['user'=> function ($query){
            $query->withTrashed();
        }])
        ->where('estado', '=',true)->get();
        return view('livewire.directorios.directorio-modal',compact('directorios'));
    }
}
