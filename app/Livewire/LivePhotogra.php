<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proyects;
use Livewire\WithPagination;
class LivePhotogra extends Component
{
    use WithPagination;
    public function render()
    {
        $projects = Proyects::where('PRO_STATUS', '1')->paginate(5);
        return view('livewire.live-photogra',compact('projects'));
    }
}
