<?php

namespace App\Livewire;

use App\Http\Services\UserService;
use App\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UpdateUser extends Component
{

    #[Locked]
    public $id ;

    #[Rule('required|min:3')]
    public $name ;

    #[Rule('required|unique:users')]
    public $email ;

    public $password ;

    public $password_confirmation ;

    public function mount(User $user){
        $this->fill(
            $user->only('name', 'email','id'),
        );

    }

    public function update(){

        $userService = new UserService();

        $data=[
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>$this->password,
            'password_confirmation'=>$this->password_confirmation,
        ];
        $userService->update($data);

        session()->flash('success','User Updated');

        return redirect('users');
    }


    public function render()
    {
        return view('livewire.update-user');
    }
}
