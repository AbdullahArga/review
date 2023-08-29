<?php
namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ImageService{
    //store
    public function store($file){
        $filename = 'note_image'.now()->format("Y_m_d_H_i_s");

        $file->storeAs('notes', $filename,'public');
        return $filename;
        }
    //update
    public function update($current,$file){
        if($current != $file){
            @unlink($current);
            return $this->store($file);

        }
        return $current;
    }
    //delete
    public function delete($filename){
            @unlink($filename);
    }

}
