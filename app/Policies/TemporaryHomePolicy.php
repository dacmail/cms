<?php

namespace App\Policies;

use App\Models\Animals\TemporaryHome;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TemporaryHomePolicy
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
     * Determine whether the user can view the temporaryhome.
     *
     * @param  \App\Models\Users\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.temporaryhomes',
            'admin.panel.temporaryhomes.view'
        ]);
    }

    /**
     * Determine whether the user can create temporaryhomes.
     *
     * @param  \App\Models\Users\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.temporaryhomes'
        ]);
    }

    /**
     * Determine whether the user can update the temporaryhome.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Animals\TemporaryHome  $temporaryhome
     * @return mixed
     */
    public function update(User $user, TemporaryHome $temporaryhome)
    {
        return $user->hasPermissions([
            'admin.panel.temporaryhomes'
        ]);
    }

    /**
     * Determine whether the user can delete the temporaryhome.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Animals\TemporaryHome  $temporaryhome
     * @return mixed
     */
    public function delete(User $user, TemporaryHome $temporaryhome)
    {
        return $user->hasPermissions([
            'admin.panel.temporaryhomes'
        ]);
    }
}
