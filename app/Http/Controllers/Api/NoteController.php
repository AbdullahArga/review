<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Resources\NoteResource;
use App\Http\Services\NoteService;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public $noteService ;
    public function __construct()
    {
        $this->noteService = new NoteService();
    }
    public function store(StoreNoteRequest $request){

        $this->noteService->store($request->validated());

        return response()->json([
            'state'=>true,
            'message'=>'note is created'
        ]);
    }
    public function update(StoreNoteRequest $request,Note $note){

        $this->noteService->store($request->validated());

        return response()->json([
            'state'=>true,
            'message'=>'note is updated'
        ]);
    }
    public function edit(Request $request,Note $note){
        $note=Note::where('user_id',auth()->id())->firstOrFail();
        return new NoteResource($note);
    }
    public function index(Request $request){

        $notes = $this->noteService->selfNotes();

        return NoteResource::collection($notes);
    }

    public function publicNotes(Request $request){
        $notes = $this->noteService->publicNotes();

        return NoteResource::collection($notes);
    }
    public function delete(Note $note){

        $notes = $this->noteService->delete($note);

        return response()->json([
            'state'=>true,
            'message'=>'note is deleted'
        ]);
    }

}
