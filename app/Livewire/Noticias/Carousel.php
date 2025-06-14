<?php

namespace App\Livewire\Noticias;

use App\Models\Noticia;
use Livewire\Component;
use Illuminate\Contracts\Support\Renderable;

class Carousel extends Component
{
    public function render():Renderable
    {
        $carousel=Noticia::latest()->take(5)->get();
        return view('livewire.noticias.carousel',compact('carousel'));
    }
}
