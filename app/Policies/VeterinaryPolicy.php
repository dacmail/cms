<?php

namespace App\Policies;

use App\Models\Users\User;
use App\Models\Veterinarians\Veterinary;
use Illuminate\Auth\Access\HandlesAuthorization;

class VeterinaryPolicy
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
     * Determine whether the user can view the veterinary.
     *
     * @param  \App\Models\Users\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.veterinarians',
            'admin.panel.veterinarians.view'
        ]);
    }

    /**
     * Determine whether the user can create veterinarians.
     *
     * @param  \App\Models\Users\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.veterinarians'
        ]);
    }

    /**
     * Determine whether the user can update the veterinary.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Veterinarians\Veterinary  $veterinary
     * @return mixed
     */
    public function update(User $user, Veterinary $veterinary)
    {
        return $user->hasPermissions([
            'admin.panel.veterinarians'
        ]);
    }

    /**
     * Determine whether the user can delete the veterinary.
     *
     * @param  \App\Models\Users\User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.veterinarians'
        ]);
    }
}
