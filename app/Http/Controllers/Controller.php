<?php

namespace App\Http\Controllers;

use App\Http\Services\NoteService;
use App\Models\Note;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function home(){
        $noteService = new NoteService();
        return view('welcome',[
            'notes'=>$noteService->publicNotes()
        ]);
    }
}
