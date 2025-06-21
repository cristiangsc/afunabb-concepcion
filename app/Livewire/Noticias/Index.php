<?php

namespace App\Livewire\Noticias;

use App\Models\Noticia;
use Illuminate\Contracts\Support\Renderable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    public string $searching = '';

    public function updatingSearching(): void
    {
        $this->resetPage();
    }

    public function OpenModal($noticia = null): void
    {
        if ($noticia )
        {
            can('noticias update');
            $this->dispatch('modalNoticia', noticia:$noticia);
        }else{
            can('noticias create');
            $this->dispatch('modalNoticia');
        }

    }

    public function deleteNoticia($id):void
    {
        can('noticias delete');
        try {
            Noticia::find($id)->delete();
            $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
        }catch (\Exception $e)
        {
            $this->alert('warning', '¡No es posible eliminar!', ['position' => 'bottom-center']);
        }
    }

    public function render(): Renderable
    {
        can('noticias read');
        $noticias = Noticia::search($this->searching)->orderBy('created_at', 'DESC')->paginate(9)->withQueryString();
        return view('livewire.noticias.index', compact('noticias'));
    }
}
