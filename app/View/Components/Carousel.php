<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Carousel extends Component
{
    public $carousel;
    public string $collection;
    public string $titulo;

    /**
     * Create a new component instance.
     */
    public function __construct($carousel, string $collection, string $titulo)
    {
        //
        $this->carousel = $carousel;
        $this->collection = $collection;
        $this->titulo = $titulo;
    }

    /**
     * Get the view / contents that represent the component.
     */


    public function render(): View|Closure|string
    {
        return view('components.carousel');
    }
}
