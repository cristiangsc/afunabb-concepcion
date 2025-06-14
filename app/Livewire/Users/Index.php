<?php

namespace App\Livewire\Users;

use App\Exports\UsersExport;
use Illuminate\Contracts\Support\Renderable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;


class Index extends Component
{

    use WithPagination, LivewireAlert;

    public string $search = '';
    public string $sort = 'created_at';
    public string $direction = 'desc';
    public int $cant = 5;


    protected array $queryString = [
        'cant' => ['except' => 3],
        'sort' => ['except' => 'paterno'],
        'direction' => ['except' => 'asc'],
        'search'
    ];
    public int $user = 0;
    protected $listeners = ['confirmed','confirmedDelete'];

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

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

   public function userDelete(User $user): void
   {
       can('usuarios delete');
       $this->dispatch('userDelete', user:$user);
   }

    public function restaurarSocio($user): void
    {
        can('usuarios restaurar');
        $this->user = $user;
        $this->confirm('¿ Desea restaurar este registro ?', [
            'onConfirmed' => "confirmed"
        ]);
    }

    public function confirmed(): void
    {
        User::withTrashed()->find($this->user)->restore();
        $this->alert('info', '¡El registro ha sido restaurado con éxito!', ['position' => 'bottom-center']);
    }

    public function confirmedDelete():void
    {
        try {
            User::withTrashed()->find($this->user)->forceDelete();
            $this->alert('info', '¡El registro ha sido eliminado con éxito!', ['position' => 'bottom-center']);
            $this->reset();
        }catch (\Exception $e){
            $this->alert('warning', '¡No es posible eliminar de forma difinitiva, existen datos asociados a este registro!', ['position' => 'bottom-center']);
        }
    }

    public function borradoSocio($user): void
    {
        can('usuarios restaurar');
        $this->user = $user;
        $this->confirm('¿Desea eliminar de forma definitiva este registro, si hay datos asociados no podrá eliminarlo?', [
            'onConfirmed' => "confirmedDelete"
        ]);
    }

    public function showModalCreate(): void
    {
        can('usuarios create');
        $this->dispatch('showModalCreate');
    }

    public function AddPermission($user): void
    {
        can('role update');
        $model = 'user';
        $this->dispatch('Permission', model_id:$user, model:$model);
    }

    public function showModalView(User $user): void
    {
        can('usuarios read');
        $this->dispatch('showModalView', user:$user);
    }

    public function showModalEdit(User $user): void
    {
        can('usuarios update');
        $this->dispatch('showModalEdit', user:$user);
    }

    #[On('render-search')]
    public function buscador($search): void
    {
        $this->search=$search;
    }


    public function exportUser()
    {
        can('socios export');
        return Excel::download(new UsersExport, 'socios.xlsx');
    }

    #[On('UpdateTable')]
    public function render():Renderable
    {
        $users = User::search($this->search)->orderBy($this->sort, $this->direction)->paginate($this->cant);
        return view('livewire.users.index',compact('users'));
    }
}
