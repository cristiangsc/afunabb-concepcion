<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListNoticia extends Component
{
    public $noticias;

    /**
     * Create a new component instance.
     */
    public function __construct($noticias)
    {
        //
        $this->noticias = $noticias;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.list-noticia');
    }
}
