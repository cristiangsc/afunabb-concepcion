<?php

namespace App\Livewire\Actas;

use App\Models\Acta;
use Illuminate\Contracts\Support\Renderable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert, WithPagination, WithFileUploads;

    public bool $showModal = false;
    public bool $showModalPdf = false;
    public string $sort = 'title';
    public string $direction = 'desc';
    public string $urlActa = '', $namePdf = '';
    public $pdf;
    public string $title = '';
    public $fecha;
    public string $search = '';

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
            $this->direction = 'desc';
        }
    }

    public function showActa($id):void
    {
        can('actas read');
        $acta = Acta::find($id)->getMedia('actas')->first();
        $this->urlActa =$acta->getUrl();
        $this->namePdf = $acta->name;
        $this->showModalPdf = !$this->showModalPdf;
    }

    public function OpenModalActaCreate(): void
    {
        can('actas create');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->showModal = !$this->showModal;
    }

    public function store():void
    {
        $this->validate([
            'pdf'=> 'required|max:3048|file|mimes:pdf',
            'title'=>'required|min:5|unique:actas,title',
            'fecha'=>'required'
        ]);

        $acta = Acta::create([
            'title' => strtoupper($this->title),
            'fecha' => $this->fecha,
        ]);
        $acta->addMedia($this->pdf)->toMediaCollection('actas');
        $this->alert('success', 'Acta almacenada exitosamente', ['position' => 'bottom-center']);
        $this->reset('pdf','title','fecha');
    }

    public function deleteActa(Acta $acta): void
    {
        can('actas delete');
        Acta::find($acta->id)->delete();
        $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
    }


    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render():Renderable
    {
        can('actas read');
        $actas = Acta::orWhere('title','like','%' .$this->search . '%')->orderBy($this->sort, $this->direction)->paginate(10);
        return view('livewire.actas.index', compact('actas'));
    }
}
