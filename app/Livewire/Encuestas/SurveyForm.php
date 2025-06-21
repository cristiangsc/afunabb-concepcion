<?php

namespace App\Livewire\Encuestas;

use App\Models\Survey;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SurveyForm extends Component
{

    public $title;
    public $description;
    public $start_at;
    public $end_at;

    public $questions = [];

    public function mount(): void
    {
        $this->questions = [
            ['question' => '', 'options' => [['option_text' => '']]]
        ];
    }

    public function addQuestion(): void
    {
        $this->questions[] = ['question' => '', 'options' => [['option_text' => '']]];
    }

    public function removeQuestion($index): void
    {
        unset($this->questions[$index]);
        $this->questions = array_values($this->questions);
    }

    public function addOption($questionIndex): void
    {
        $this->questions[$questionIndex]['options'][] = ['option_text' => ''];
    }

    public function removeOption($questionIndex, $optionIndex): void
    {
        unset($this->questions[$questionIndex]['options'][$optionIndex]);
        $this->questions[$questionIndex]['options'] = array_values($this->questions[$questionIndex]['options']);
    }

    public function submit():RedirectResponse
    {
        $this->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after_or_equal:start_at',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.options' => 'required|array|min:2',
            'questions.*.options.*.option_text' => 'required|string'
        ]);

        $survey = Survey::create([
            'title' => $this->title,
            'description' => $this->description,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'user_id' => Auth::id(),
        ]);

        foreach ($this->questions as $qData) {
            $question = $survey->questions()->create(['question' => $qData['question']]);

            foreach ($qData['options'] as $optData) {
                $question->options()->create(['option_text' => $optData['option_text']]);
            }
        }

        session()->flash('success', 'Encuesta creada exitosamente.');
        return redirect()->route('encuestas.surveys.index');
    }

    public function render():Renderable
    {
        return view('livewire.encuestas.survey-form');
    }
}
