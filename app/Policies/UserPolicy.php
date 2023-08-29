<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user,$data): bool
    {
        if($data['is_admin']??null)
        return $user->is_admin;
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, $data): bool
    {
        if($data['is_admin']??null)
        return $user->is_admin;
        return true;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $this->isNotMe($model->id)
            &&$this->isAdmin();
    }
    public function isNotMe($id){

        return $id != auth()->id();
    }
    //TODO - add is_admin column for users table
    public function isAdmin(){
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        //
    }
}
