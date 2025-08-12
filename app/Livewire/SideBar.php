<?php

namespace App\Livewire;

use Livewire\Component;

class SideBar extends Component
{
    public int $tasksCount = 0;

    public function render()
    {
        return view('livewire.side-bar');
    }
}
