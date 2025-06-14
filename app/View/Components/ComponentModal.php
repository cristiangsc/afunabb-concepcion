<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ComponentModal extends Component
{
    public string $title;
    public bool $showModal=false;
    public string $action;

    public function __construct(string $title, bool $showModal, string $action='')
    {
       $this->title = $title;
        $this->showModal = $showModal;
        $this->action = $action;
    }

    public function render(): View|Closure|string
    {
        return view('components.component-modal');
    }
}
