<?php

namespace App\Livewire\Directorios\Photo;

use App\Models\PhotoDirectiva;
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

    public function OpenModalPhoto(PhotoDirectiva $photoDirectiva = null): void
    {
        $this->reset('title','imagen','imagenEdit');
        $this->resetErrorBag();
        $this->resetValidation();
        if (!empty($photoDirectiva->title)) {
            $photoDirectiva = PhotoDirectiva::with('media')->find($photoDirectiva->id);
            $this->title = $photoDirectiva->title;
            $this->id = $photoDirectiva->id;
            $this->imagenEdit = $photoDirectiva->getFirstMediaUrl('directivas');
            $this->button = 'Update';
            $this->titleForm = 'Actualizar Slides';
        } else {
            $this->button = 'Save all';
            $this->titleForm = 'Crear Fotografía ';
        }
        $this->showModal = !$this->showModal;
    }

    public function save(): void
    {
        if ($this->button == 'Update')
        {
            $this->validate([
                'imagen' => 'nullable|max:2048|image|mimes:jpg,jpeg,bmp,png',
                'title' => 'required|min:5',
            ]);
            $photoDirectiva = PhotoDirectiva::find($this->id);
            $photoDirectiva->update(['title' => strtoupper($this->title)]);
            if ($this->imagen)
            {
                $imagen= $photoDirectiva->getMedia('directivas')->first();
                $imagen->delete();
                $photoDirectiva->addMedia($this->imagen)->toMediaCollection('directivas');
            }
            $this->alert('success', 'Fotografía directiva actualizada exitosamente', ['position' => 'bottom-center']);
        }else {
            $this->validate([
                'imagen' => 'required|max:2048|image|mimes:jpg,jpeg,bmp,png',
                'title' => 'required|min:5',
            ]);
            $photoDirectiva = PhotoDirectiva::create(['title' => strtoupper($this->title)]);
            $photoDirectiva->addMedia($this->imagen)->toMediaCollection('directivas');
            $this->alert('success', 'Slide creado exitosamente', ['position' => 'bottom-center']);
        }
        $this->reset();
    }

    public function deletePhoto($id):void
    {
        try {
            PhotoDirectiva::find($id)->delete();
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
        $photos = PhotoDirectiva::latest()->get();
        return view('livewire.directorios.photo.index',compact('photos'));
    }
}


