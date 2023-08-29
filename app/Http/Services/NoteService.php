<?php
namespace App\Http\Services;

use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class NoteService
{
    //index
    public function index($self = false, $isAdmin = false)
    {
        return Note::self($self)
            ->admin($isAdmin)
            ->search()
            ->latest('updated_at','created_at')
            ;
    }
    public function publicNotes()
    {
        $self = false;
        $isAdmin = true;
        return $this->index($self, $isAdmin)->select(['title','body','image','created_at','updated_at'])->paginate(request()->input('limit', 10));
    }
    public function selfNotes()
    {
        $self = true;
        $isAdmin = false;
        return $this->index($self, $isAdmin)->paginate(request()->input('limit', 10));
    }
    //store
    public function store($data)
    {
        $note = Note::create([
            'title' => $data['title'] ?? null,
            'body' => $data['body'],
            'image' => $data['image'] ?? null,
            'user_id' => auth()->id(),
            'is_active' => $data['is_active'] ?? null,
            'is_admin' => auth()
                ->user()
                ->isAdmin(),
        ]);
        return $note;
    }
    //update
    public function update($data)
    {
        $note = Note::find($data['id']);
        Gate::authorize('update', [Note::class, $note]);
        $note->update([
            'title' => $data['title'] ?? null,
            'body' => $data['body'],
            'image' => $data['image'] ?? null,
            'user_id' => auth()->id(),
            'is_active' => $data['is_active'] ?? $note->is_active,
            'is_admin' => auth()
                ->user()
                ->isAdmin(),
        ]);
        return $note;
    }
    //delete
    public function delete($note)
    {
        Gate::authorize('delete', [Note::class, $note]);

        $note->deleteImage();
        $note->delete();
    }
}
