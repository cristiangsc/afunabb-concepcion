<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalDinamic extends Component
{
    public bool $openCloseModal = false;
    public string $actionTarget;
    public string $title;
    public string $button;

    /**
     * Create a new component instance.
     */
    public function __construct( $actionTarget,  $title, $button, $openCloseModal )
    {
        $this->openCloseModal = $openCloseModal;
        $this->actionTarget = $actionTarget;
        $this->title = $title;
        $this->button = $button;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-dinamic');
    }
}
