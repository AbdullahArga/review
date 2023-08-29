<?php

namespace App\Livewire;

use App\Http\Services\UserService;
use Livewire\Component;

class CreateUser extends Component
{
    #[Rule('required|min:3')]
    public $name ;

    #[Rule('required|unique:users')]
    public $email ;

    #[Rule('required|min:6|confirmed')]
    public $password ;

    public $password_confirmation ;

    public function store(){

        $userService = new UserService();

        $data=[
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>$this->password,
            'password_confirmation'=>$this->password_confirmation,
        ];
        $userService->store($data);

        session()->flash('success','User Created');

        return redirect('users');
    }

    public function render()
    {
        return view('livewire.create-user');
    }
}
