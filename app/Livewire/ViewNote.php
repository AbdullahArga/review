<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Component;

class ViewNote extends Component
{
    public $note;

    public function mount(Note $note){
        $this->note = $note;
    }
    public function render()
    {
        return view('livewire.view-note',[
            'note'=>$this->note
        ]);
    }
}
