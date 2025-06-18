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

    public array $images = [];

    public function mount(Gallery $id):void
    {
        $this->gallery = $id;
    }

    public function store(): void
    {
        $this->validate([
            'images'   => 'required|array',
            'images.*' => 'image|max:4048|mimes:jpg,jpeg,bmp,png'
        ]);

        $gallery = Gallery::find($this->gallery->id);

        foreach ($this->images as $image) {
            $gallery->addMedia($image)
                ->toMediaCollection('galleries');
        }

        $this->alert('success', 'Imagen almacenada exitosamente', ['position' => 'bottom-center']);
        $this->reset('images');
    }

    public function removeImage($index): void
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images); // Reindexar el array
    }

    public function render(): Renderable
    {
        can('fotos create');
        return view('livewire.galeria.upload');
    }
}
