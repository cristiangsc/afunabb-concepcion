<?php

namespace App\View\Components\Principal;

use App\Models\Noticia;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class News extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $noticias = Noticia::with(['user'=> function ($query){
            $query->withTrashed();
        }])
        ->orderBy('created_at', 'DESC')->take(6)->get();
        return view('components.principal.news',compact('noticias'));
    }
}
