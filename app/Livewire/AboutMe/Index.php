<?php

namespace App\Livewire\AboutMe;

use App\Models\Antecedente;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads, LivewireAlert;

    public $imagen = null;
    public $imagenEdit = null;
    public string $history = '';
    public string $mission = '';
    public string $vision = '';
    public bool $showModal = false;
    public int $id;

    public function OpenModal(Antecedente $antecedente): void
    {
        can('acerca update');
        $this->history = $antecedente->history;
        $this->mission = $antecedente->mission;
        $this->vision = $antecedente->vision;
        $this->id = $antecedente->id;
        $this->imagenEdit = $antecedente->getFirstMediaUrl('abouts');
        $this->showModal = !$this->showModal;
    }

    public function save(): void
    {
        $this->validate([
            'imagen' => 'nullable|max:2048|image|mimes:jpg,jpeg,bmp,png',
            'history' => 'required|min:5',
            'mission' => 'required|min:5',
            'vision' => 'required|min:5'
        ]);
        $antecedentes = Antecedente::find($this->id);
        $antecedentes->update([
            'history' => $this->history,
            'mission' => $this->mission,
            'vision' => $this->vision,
        ]);
        if ($this->imagen) {
            $imagen = $antecedentes->getMedia('abouts')->first();
           if($imagen){
                $imagen->delete();
            }
            $antecedentes->addMedia($this->imagen)->toMediaCollection('abouts');
        }
        $this->alert('success', 'Información actualizada exitosamente', ['position' => 'bottom-center']);
        $this->reset();
    }

    public function updatedImagen(): void
    {
        $this->imagenEdit = null;
    }

    public function render(): view
    {
        $about = Antecedente::all()->first();
         return view('livewire.about-me.index', compact('about'));
    }
}
