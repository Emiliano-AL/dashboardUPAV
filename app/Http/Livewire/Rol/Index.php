<?php

namespace App\Http\Livewire\Rol;

use App\Models\Rol;
use Livewire\WithPagination;
use Livewire\Component;

class Index extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $rols = Rol::where('name', 'Like', '%'.$this->search.'%')   
                    ->paginate(10);
        return view('livewire.rol.index', compact('rols'));
    }
}
