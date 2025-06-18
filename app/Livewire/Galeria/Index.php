<?php

namespace App\Livewire\Galeria;

use App\Models\Gallery;
use Illuminate\Contracts\Support\Renderable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert, WithPagination;

    public bool $OpenCloseModal = false;
    public string $actionTarget = '';
    public string $titleModal = '';
    public string $buttonGallery = '';
    public Gallery $gallery;
    public string $sort = 'created_at';
    public string $direction = 'asc';
    protected $listeners = ['confirmed'];
    public string $search='';

    #[Rule('required|min:5|unique:galleries,title')]
    public string $title = '';

    protected array $queryString = [
        'sort' => ['except' => 'title'],
        'direction' => ['except' => 'asc']
    ];

    public function order($sort): void
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function OpenModalGalleryCreate(Gallery $gallery = null): void
    {
        $this->title = '';
        $this->resetErrorBag();
        $this->resetValidation();
        if (!empty($gallery->title)) {
            can('galeria update');
            $this->gallery = $gallery;
            $this->title = $gallery->title;
            $this->actionTarget = "updateGallery";
            $this->titleModal = "Actualizar Galería";
            $this->buttonGallery = "Update";
        } else {
            can('galeria create');
            $this->actionTarget = "createGallery";
            $this->titleModal = "Crear nueva Galería";
            $this->buttonGallery = "Save all";
        }
        $this->OpenCloseModal = !$this->OpenCloseModal;
    }

    public function CloseModal(): void
    {
        $this->OpenCloseModal = false;
    }

    public function updateGallery(): void
    {
        $this->validate();
        $this->gallery->update(['title' => strtoupper($this->title)]);
        $this->reset();
    }

    public function createGallery(): void
    {
        $this->validate();
        Gallery::create([
            'title' => strtoupper($this->title)
        ]);
        $this->reset('title');
        $this->alert('info', '¡El registro ha sido creado con éxito!', ['position' => 'bottom-center']);
    }

    public function deleteGallery(Gallery $gallery): void
    {
        can('galeria delete');
        $this->gallery = $gallery;
        $this->confirm('¿Desea borrar este registro?', [
            'onConfirmed' => "confirmed"
        ]);
    }

    public function confirmed(): void
    {
        try {
            Gallery::find($this->gallery->id)->delete();
            $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
            $this->reset();
        }catch (\Exception $e)
        {
            $this->alert('warning', '¡No es posible eliminar!', ['position' => 'bottom-center']);
        }
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): Renderable
    {
        can('galeria read');
        $galleries = Gallery::orWhere('title','like','%' .$this->search . '%')->orderBy($this->sort, $this->direction)->paginate();
        return view('livewire.galeria.index', compact('galleries'));
    }
}
