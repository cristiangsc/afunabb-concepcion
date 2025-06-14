<?php

namespace App\Livewire\Utility;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class SearchInput extends Component
{
    public string $search='';

    public function updatedSearch(): void
    {
        $this->dispatch('render-search',search:$this->search);
    }

    public function render():Renderable
    {
        return view('livewire.utility.search-input');
    }
}
