<?php

namespace App\Livewire\Slides;

use App\Models\Slide;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use LivewireAlert, WithFileUploads;

    public string $title = '';
    public bool $showModal = false;
    public string $titleForm = '';
    public string $button = '';
    public  $imagen, $imagenEdit;
    public mixed $id;

    public function OpenModalSlide(Slide $slide = null): void
    {
        $this->reset('title','imagen','imagenEdit');
        $this->resetErrorBag();
        $this->resetValidation();
        if (!empty($slide->title)) {
            can('slides update');
            $slide = Slide::with('media')->find($slide->id);
            $this->title = $slide->title;
            $this->id = $slide->id;
            $this->imagenEdit = $slide->getFirstMediaUrl('slides');
            $this->button = 'Update';
            $this->titleForm = 'Actualizar Slides';
        } else {
            can('slides create');
            $this->button = 'Save all';
            $this->titleForm = 'Crear Slide ';
        }
        $this->showModal = !$this->showModal;
    }

    public function save(): void
    {
        if ($this->button == 'Update')
        {
            $this->validate([
                'imagen' => 'nullable|max:5048|image|mimes:jpg,jpeg,bmp,png',
                'title' => 'required|min:5',
            ]);
            $slide = Slide::find($this->id);
            $slide->update(['title' => strtoupper($this->title)]);
            if ($this->imagen)
            {
                $imagen= $slide->getMedia('slides')->first();
                $imagen->delete();
                $slide->addMedia($this->imagen)->toMediaCollection('slides');
            }
            $this->alert('success', 'Slide actualizado exitosamente', ['position' => 'bottom-center']);
        }else {
            $this->validate([
                'imagen' => 'required|max:5048|image|mimes:jpg,jpeg,bmp,png',
                'title' => 'required|min:5',
            ]);
            $slide = Slide::create(['title' => strtoupper($this->title)]);
            $slide->addMedia($this->imagen)->toMediaCollection('slides');
            $this->alert('success', 'Slide creado exitosamente', ['position' => 'bottom-center']);
        }
        $this->reset();
    }

    public function deleteSlide($id):void
    {
        can('slides delete');
        try {
            Slide::find($id)->delete();
            $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
        }catch (\Exception $e)
        {
            $this->alert('warning', '¡No es posible eliminar!', ['position' => 'bottom-center']);
        }
    }

    public function updatedImagen():void
    {
        $this->imagenEdit = null;
    }


    public function render():view
    {
        can('slides read');
        $slides = Slide::orderBy('created_at', 'DESC')->get();
        return view('livewire.slides.index',compact('slides'));
    }
}
