<?php

namespace App\Livewire\Encuestas;

use App\Models\Survey;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class SurveyIndexComponent extends Component
{
    public function render():Renderable
    {
        $surveys = Survey::where('start_at', '<=', now())
            ->where('end_at', '>=', now())
            ->get();
        return view('livewire.encuestas.survey-index-component',compact('surveys'));
    }
}
