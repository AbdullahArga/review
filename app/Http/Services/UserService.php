<?php
namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserService{
    public function store($data){
        //validate
        $this->storeValidate($data);

        if($user=auth()->user())
        Gate::authorize('create',[$user , $data]);

        //store
        $user =User::create(
            [
                'name'=>$data['name'],
                'email'=>$data['email'],
                'password'=>Hash::make($data['password']),
                'is_admin'=>$data['is_admin']??null?true:false,
            ]
        );
        //response
        return $user;

        }
        public function storeValidate($data){
            Validator::make($data, [
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required|min:6|confirmed',
            ])->validate();

        }

        public function update($data){

            Gate::authorize('create',[auth()->user() , $data]);
            //validation
            $this->updateValidate($data);
            //update
            $user = User::find($data['id']);
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->is_admin = $data['is_admin']??null?true:false;

            $user->save();

            //response
            return $user;
        }
        public function updateValidate($data){
            Validator::make($data, [
                'name' => 'required',
                'email' => ['required',Rule::unique('users', 'email')->ignore($data['id'])],
                'password' => $data['password']?'min:6|confirmed':'nullable',
            ])->validate();

        }

        public function delete($id){
            $user = User::findOrFail($id);

            Gate::authorize('delete',$user);


            $user->delete();
        }
}
