<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function adminFunction(User $user){
        return $user->user_level->name == 'administrator';
    }

    public function view(User $user){
        return $user->user_level->name != 'user';
    }
}
