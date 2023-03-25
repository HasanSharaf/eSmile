<?php

namespace Modules\User\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Entities\User;

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

    public function listUsers(User $user)
    {
        return $user->integraCan('list_users');
    }

    public function createUser(User $user)
    {
        return $user->integraCan('create_user');
    }
}
