<?php

namespace App\Livewire\Noticias;

use App\Models\Noticia;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class Show extends Component
{
    public int $id;

    public function render():Renderable
    {
        can('noticias read');
        $noticias = Noticia::with('media')->orderBy('created_at','DESC')->take(5)->get();
        $noticia = Noticia::with('media','user')->find($this->id);
        return view('livewire.noticias.show',compact('noticia','noticias'));
    }
}
