<?php

namespace App\Policies;

use App\User;
use App\Password;
use Illuminate\Auth\Access\HandlesAuthorization;

class PasswordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the password.
     *
     * @param  \App\User  $user
     * @param  \App\Password  $password
     * @return mixed
     */
    public function view(User $user, Password $password)
    {
        //
    }

    /**
     * Determine whether the user can create passwords.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the password.
     *
     * @param  \App\User  $user
     * @param  \App\Password  $password
     * @return mixed
     */
    public function update(User $user, Password $password)
    {
        return $password->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the password.
     *
     * @param  \App\User  $user
     * @param  \App\Password  $password
     * @return mixed
     */
    public function delete(User $user, Password $password)
    {
        //
    }
}
