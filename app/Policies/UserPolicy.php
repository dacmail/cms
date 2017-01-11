<?php

namespace App\Policies;

use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user is volunteer or admin
     * @param $user
     * @return bool
     */
    public function before($user)
    {
        if (! $user->isAdminOrVolunteer()) {
            return false;
        }
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.users',
            'admin.panel.users.view'
        ]);
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.users'
        ]);
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param User $user
     * @param User $to_user
     * @return mixed
     */
    public function update(User $user, User $to_user)
    {
        return $user->hasPermissions([
            'admin.panel.users'
        ]);
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param User $user
     * @param User $to_user
     * @return mixed
     */
    public function delete(User $user, User $to_user)
    {
        return $user->hasPermissions([
            'admin.panel.users'
        ]);
    }
}
