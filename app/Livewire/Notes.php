<?php

namespace App\Livewire;

use App\Http\Services\NoteService;
use App\Models\Note;
use Livewire\Component;
use Livewire\WithPagination;

class Notes extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.notes',['notes'=>Note::with('user')->latest('updated_at','created_at')->paginate(6)]);
    }
    public function delete(Note $note){
        $noteService = new NoteService();
        $noteService->delete($note);
        session()->flash('success','Note Deleted');

    }
}
