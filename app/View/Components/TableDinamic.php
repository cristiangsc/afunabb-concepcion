<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableDinamic extends Component
{
    public string $caption;
    public $paginacion;

    public function __construct(string $caption, $paginacion= null)
    {
        $this->caption = $caption;
        $this->paginacion = $paginacion;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table-dinamic');
    }
}
