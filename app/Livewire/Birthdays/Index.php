<?php

namespace App\Livewire\Birthdays;

use App\Models\Birthday;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use LivewireAlert, WithFileUploads;

    public string $mensaje = '';
    public bool $showModal = false;
    public string $titleForm = '';
    public string $button = '';
    public  $imagen, $imagenEdit;
    public mixed $id;

    public function OpenModalSaludo(Birthday $birthday = null): void
    {
        $this->reset('mensaje','imagen','imagenEdit');
        $this->resetErrorBag();
        $this->resetValidation();
        if (!empty($birthday->mensaje)) {
            can('cumpleaños update');
            $birthday = Birthday::with('media')->find($birthday->id);
            $this->mensaje = strtoupper($birthday->mensaje);
            $this->id = $birthday->id;
            $this->imagenEdit = $birthday->getFirstMediaUrl('saludos');
            $this->button = 'Update';
            $this->titleForm = 'Actualizar Saludo';
        } else {
            can('cumpleaños create');
            $this->button = 'Save all';
            $this->titleForm = 'Crear Saludo de cumpleaños ';
        }
        $this->showModal = !$this->showModal;
    }

    public function save(): void
    {
        if ($this->button == 'Update')
        {
            $this->validate([
                'imagen' => 'nullable|max:2048|image|mimes:jpg,jpeg,bmp,png',
                'mensaje' => 'required|min:5',
            ]);
            $birthday = Birthday::find($this->id);
            $birthday->update(['mensaje' => strtoupper($this->mensaje)]);
            if ($this->imagen)
            {
                $imagen= $birthday->getMedia('saludos')->first();
                $imagen->delete();
                $birthday->addMedia($this->imagen)->toMediaCollection('saludos');
            }
            $this->alert('success', 'Saludo de cumpleaños actualizado exitosamente', ['position' => 'bottom-center']);
        }else {
            $this->validate([
                'imagen' => 'required|max:2048|image|mimes:jpg,jpeg,bmp,png',
                'mensaje' => 'required|min:5',
            ]);
            $birthday = Birthday::create(['mensaje' => strtoupper($this->mensaje)]);
            $birthday->addMedia($this->imagen)->toMediaCollection('saludos');
            $this->alert('success', 'Saludo de cumpleaños creado exitosamente', ['position' => 'bottom-center']);
        }
        $this->reset();
    }

    public function deleteSaludo($id):void
    {
        can('cumpleaños delete');
        try {
            Birthday::find($id)->delete();
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
        can('cumpleaños read');
        $saludos = Birthday::orderBy('created_at', 'DESC')->get();
        return view('livewire.birthdays.index',compact('saludos'));
    }
}


