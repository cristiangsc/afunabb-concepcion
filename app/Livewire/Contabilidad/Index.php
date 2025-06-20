<?php

namespace App\Livewire\Contabilidad;

use App\Models\Finanza;
use Illuminate\Contracts\Support\Renderable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{

    use LivewireAlert, WithPagination, WithFileUploads;

    public bool $showModal = false;
    public bool $showModalDocument = false;
    public string $sort = 'title';
    public string $direction = 'asc';
    public string $urlDocument = '', $nameDocument = '';
    public string $extension = '';
    public $file;
    public string $search='';
    public string $title = '';

    protected array $queryString = [
        'sort' => ['except' => 'title'],
        'direction' => ['except' => 'asc']
    ];


    public function order($sort): void
    {
        if ($this->sort == $sort) {
            if ($this->direction === 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function showDocument($id)
    {
        can('finanza read');
        $document = Finanza::find($id)->getMedia('finanzas')->first();
        $this->extension = getExtension($document->file_name, true);
        if ($this->extension === 'pdf') {
            $this->urlDocument = $document->getUrl();
            $this->nameDocument = $document->name;
            $this->showModalDocument = !$this->showModalDocument;
        }
        else{
            $this->alert('success', 'Documento descargándose', ['position' => 'bottom-center']);
            return response()->download($document->getPath(), $document->file_name);
        }
        return null;
    }

    public function OpenModalDocumentCreate(): void
    {
        can('finanza create');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->showModal = !$this->showModal;
    }

    public function store(): void
    {
        $this->validate([
            'file' => 'required|max:4048|file|mimes:pdf,docx,xlsx,pptx',
            'title' => 'required|min:5|unique:documentos,title'
        ]);
        $document = Finanza::create([
            'title' => strtoupper($this->title)
        ]);
        $document->addMedia($this->file)->toMediaCollection('finanzas');
        $this->alert('success', 'Documento almacenado exitosamente', ['position' => 'bottom-center']);
        $this->reset('file', 'title');
    }

    public function deleteDocument(Finanza $finanza): void
    {
        can('finanza delete');
        Finanza::find($finanza->id)->delete();
        $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): Renderable
    {
        can('finanza read');
        $documents = Finanza::with('media')->orWhere('title','like','%' .$this->search . '%' )->orderBy($this->sort, $this->direction)->paginate();
        return view('livewire.contabilidad.index', compact('documents'));
    }
}
