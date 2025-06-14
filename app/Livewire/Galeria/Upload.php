<?php

namespace App\Livewire\Galeria;

use App\Models\Gallery;
use Illuminate\Contracts\Support\Renderable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads, LivewireAlert;

    public Gallery $gallery;

    public $image;

    public function mount(Gallery $id):void
    {
        $this->gallery = $id;
    }

    public function store(): void
    {
        $this->validate([
            'image'=> 'required|max:3048|image|mimes:jpg,jpeg,bmp,png'
        ]);

        $gallery = Gallery::find($this->gallery->id);
        $gallery->addMedia($this->image)
        ->toMediaCollection('galleries');

        $this->alert('success', 'Imagen almacenada exitosamente', ['position' => 'bottom-center']);
        $this->reset('image');
    }

    public function render(): Renderable
    {
        can('fotos create');
        return view('livewire.galeria.upload');
    }
}
