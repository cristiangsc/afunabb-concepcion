<?php

namespace App\Livewire\Encuestas;

use App\Models\Survey;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class SurveyResultsComponent extends Component
{
    public Survey $survey;

    public function mount(Survey $survey): void
    {
        abort_if(now()->lt($survey->end_at), 403);
        $this->survey = $survey;
    }

    public function render():Renderable
    {
        return view('livewire.encuestas.survey-results-component');
    }
}
