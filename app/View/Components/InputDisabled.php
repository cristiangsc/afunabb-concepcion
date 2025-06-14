<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class InputDisabled extends Component
{
    /**
     * Create a new component instance.
     */

    public string $label;
    public string $name;
    public string $type;
    public function __construct(string $label, string $name, string $type = 'text')
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-disabled');
    }
}
