<?php

namespace App\Livewire\Encuestas;

use App\Models\Response;
use App\Models\Survey;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class SurveyShowComponent extends Component
{
    public Survey $survey;
    public $responses = [];

    public function mount(Survey $survey): void
    {
        abort_if(now()->lt($survey->start_at) || now()->gt($survey->end_at), 403);
        $this->survey = $survey->load('questions.options');
    }

    public function submit(): void
    {
        foreach ($this->responses as $questionId => $optionId) {
            Response::updateOrCreate([
                'user_id' => auth()->id(),
                'question_id' => $questionId,
            ], [
                'option_id' => $optionId,
            ]);
        }
        $this->survey->load('questions.options');
        session()->flash('success', 'Encuesta enviada correctamente.');
    }

    public function render():Renderable
    {
        return view('livewire.encuestas.survey-show-component');
    }
}
