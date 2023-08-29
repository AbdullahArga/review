<?php

namespace App\Livewire;

use App\Http\Services\NoteService;
use App\Models\Note;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateNote extends Component
{
    use WithFileUploads;

    #[Locked]
    public $id ;

    public $title="";

    #[Rule('required|min:3')]
    public $body="";

    #[Rule('image|max:1024')] // 1MB Max
    public $image;

    public $is_active=null;

    public function store(){

        $filename = 'note_image'.now()->format("Y_m_d_H_i_s");
        if($this->image){
            $this->image->storeAs('notes', $filename,'public');
        }
        else{
            $filename=null;
        }

        $data=[
            'id'=>$this->id,
            'title'=>$this->title,
            'body'=>$this->body,
            'image'=>$filename,
            'is_active'=>$this->is_active,
        ];
        $noteService = new NoteService();

        $noteService->update($data);

        session()->flash('success','Note Updated');

        $this->reset();

        return redirect('notes');


    }

    public function render()
    {
        return view('livewire.update-note');
    }
    public function mount(Note $note){
        $this->fill($note->only(['id','title','body','is_active']));
    }
}
