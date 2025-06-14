<?php

namespace App\Livewire\Testimonials;

use App\Models\Testimony;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert, WithPagination;

    public string $testimonio='';
    public bool $showModal = false;
    public bool $update = false;
    public Testimony $testimony;

    public function OpenModalTestimonyCreate(Testimony $testimony = null): void
    {
        can('testimonios create');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset('testimonio');
        if (!empty($testimony->testimony)) {
            $this->testimonio = $testimony->testimony;
            $this->update = true;
            $this->testimony = $testimony;
        }
        $this->showModal = !$this->showModal;
    }

    public function createTestimony(): void
    {
        $this->validate([
            'testimonio' => 'required|min:20|max:500',
        ]);

        if ($this->update) {
            $this->alert('info', '¡El registro ha sido actualizado con éxito!', ['position' => 'bottom-center']);

            $this->testimony->update(['testimony'=>$this->testimonio]);
        } else {
            Testimony::create(['testimony'=>$this->testimonio]);
            $this->alert('info', '¡El registro ha sido creado con éxito!', ['position' => 'bottom-center']);
        }
        $this->reset();
    }

    public function deleteTestimony(Testimony $testimony): void
    {
        can('testimonios delete');
        Testimony::find($testimony->id)->delete();
        $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
    }


    public function render():view
    {
        can('testimonios read');
        $testimonials = auth()->user()->testimonials()->paginate(5);

        return view('livewire.testimonials.index',compact('testimonials'));
    }
}
