<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'body'=>"required|min:3",
            'image'=>"nullable|image|max:1024",
        ];
    }
    public function validated($key = null, $default = null)
    {
        return [
            'id'=>$this->note?$this->note->id:null,
            'title'=>$this->title,
            'body'=>$this->body,
            'image'=>$this->image,
        ];
    }
}
