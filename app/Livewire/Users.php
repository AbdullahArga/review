<?php

namespace App\Livewire;

use App\Http\Services\UserService;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $search="";

    public $selectedUsers = [];

    #[Rule('required|min:3')]
    public $message = "";

    public function selectAllUser(){

        $this->selectedUsers = User::select('id')
        ->where('id','!=',auth()->id())
        ->toBase()->get()->pluck('id')->toArray();

    }
    public function delete($id){
        $userService = new UserService();

        $userService->delete($id);

        session()->flash('success','User Deleted');
    }
    public function notify(){
        //do notify for users
        $users = User::whereIn('id',$this->selectedUsers)->get();
        Notification::send($users, new UserNotification($this->message));
        $this->reset('message','selectedUsers');
        session()->flash('success','Messages have been sent successfully');

    }

    public function render()
    {
        return view('livewire.users',["users"=>User::filterSearch($this->search)->paginate(5)]);
    }
}
