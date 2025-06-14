<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ComponentInput extends Component
{
    public string $label;
    public string $placeholder;
    public string $name;
    public string $type;
    public bool $mask;



    public function __construct(string $label, string $placeholder, string $name, string $type = 'text', $mask = false)
    {
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->type = $type;
        $this->mask = $mask;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.component-input');
    }
}
