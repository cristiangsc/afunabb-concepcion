<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ComponentInputSelect extends Component
{
    public string $label;
    public string $name;
    public string $campo;
    public object $options;

    /**
     * Create a new component instance.
     */
    public function __construct(string $label, string $name, string $campo, object $options)
    {
        $this->label = $label;
        $this->name = $name;
        $this->campo = $campo;
        $this->options = $options;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.component-input-select');
    }
}
