<?php

namespace App\Livewire\Galeria;

use App\Models\Gallery;
use Illuminate\Contracts\Support\Renderable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination, LivewireAlert;

    public int $id;
    public bool $showModal=false;
    public string $url;

    public function showImage($url):void
    {
        can('fotos read');
        $this->url = $url;
        $this->showModal = !$this->showModal;
    }

    public function deleteGalleryImage($idImage, $idGallery)
    {
        can('fotos delete');
        $galeria = Gallery::find($idGallery)->getMedia('galleries');
        $imagen= $galeria->where('id',$idImage)->first();
        $imagen->delete();
        $this->alert('info', '¡La imagen ha sido eliminada con éxito!', ['position' => 'bottom-center']);
    }

    public function render(): Renderable
    {
        can('fotos read');
        $imagenes = Gallery::find($this->id)->media()->where('collection_name', 'galleries')->paginate(12);//->getMedia('galleries');
        $galleryName = Gallery::find($this->id);
        return view('livewire.galeria.show', compact('imagenes', 'galleryName'));
    }
}
