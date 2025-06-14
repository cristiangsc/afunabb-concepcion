<?php

namespace App\Livewire\Noticias;

use App\Models\Noticia;
use App\Models\User;
use App\Notifications\MessageNews;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Notification;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads, LivewireAlert;

    public bool $showModal = false;
    public string $titleForm = '';
    public string $button = '';
    public string $title = '';
    public string $body = '';
    public $image, $imagenEdit;
    public mixed $id;


    #[On('modalNoticia')]
    public function OpenModalNoticia(Noticia $noticia = null): void
    {
        $this->body = '';
        $this->title = '';
        $this->image = null;
        $this->imagenEdit = null;
        $this->resetErrorBag();
        $this->resetValidation();

        if (!empty($noticia->title)) {
            can('noticias update');
            $noticia = Noticia::with('media')->find($noticia->id);
            $this->body = $noticia->body;
            $this->title = $noticia->title;
            $this->id = $noticia->id;
            $this->dispatch('editar_editor', $this->body);
            $this->imagenEdit = $noticia->getFirstMediaUrl('noticias');
            $this->button = 'Update';
            $this->titleForm = 'Actualizar Noticia';
        } else {
            can('noticias create');
            $this->dispatch('nuevo_editor');
            $this->button = 'Save all';
            $this->titleForm = 'Crear Noticia';
        }
        $this->showModal = !$this->showModal;
    }

    public function updatedImage():void
    {
        $this->imagenEdit = null;
    }

    public function save(): void
    {
        if ($this->button == 'Update')
        {
            $this->validate([
                'image' => 'nullable|max:3048|image|mimes:jpg,jpeg,bmp,png',
                'title' => 'required|min:5',
                'body' => 'required|min:5'
            ]);
            $noticia = Noticia::find($this->id);
            $noticia->update([
                'title' => strtoupper($this->title),
                'body' => $this->body
            ]);
           if ($this->image)
           {
               $imagen= $noticia->getMedia('noticias')->first();
               $imagen->delete();
               $noticia->addMedia($this->image)->toMediaCollection('noticias');
           }
            $this->alert('success', 'Noticia actualizada exitosamente', ['position' => 'bottom-center']);
        }else {
            $this->validate([
                'image' => 'required|max:3048|image|mimes:jpg,jpeg,bmp,png',
                'title' => 'required|min:5',
                'body' => 'required|min:5'
            ]);
            $noticia = Noticia::create([
                'title' => strtoupper($this->title),
                'body' => $this->body
            ]);
            $noticia->addMedia($this->image)->toMediaCollection('noticias');
            $this->alert('success', 'Noticia creada exitosamente', ['position' => 'bottom-center']);
            Notification::send(User::all(), new MessageNews($noticia));
        }
        $this->reset();
        $this->dispatch('render-search', search: '');

    }


    public function render(): Renderable
    {
        can('noticias read');
        return view('livewire.noticias.create');
    }
}
