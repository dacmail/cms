<?php

namespace App\Policies;

use App\Models\Users\User;
use App\Models\Animals\Animal;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnimalPolicy
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
     * Determine whether the user can view the animal.
     *
     * @param  \App\Models\Users\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.animals',
            'admin.panel.animals.view'
        ]);
    }

    /**
     * Determine whether the user can create animals.
     *
     * @param  \App\Models\Users\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.animals'
        ]);
    }

    /**
     * Determine whether the user can update the animal.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Animals\Animal  $animal
     * @return mixed
     */
    public function update(User $user, Animal $animal)
    {
        return $user->hasPermissions([
            'admin.panel.animals'
        ]);
    }

    /**
     * Determine whether the user can delete the animal.
     *
     * @param  \App\Models\Users\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.animals'
        ]);
    }
}
