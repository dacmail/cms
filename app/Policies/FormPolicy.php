<?php

namespace App\Policies;

use App\Models\Users\User;
use App\Models\Forms\Form;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormPolicy
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
     * Determine whether the user can view the form.
     *
     * @param  \App\Models\Users\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.forms'
        ]);
    }

    /**
     * Determine whether the user can create forms.
     *
     * @param  \App\Models\Users\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.forms'
        ]);
    }

    /**
     * Determine whether the user can update the form.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Forms\Form  $form
     * @return mixed
     */
    public function update(User $user, Form $form)
    {
        return $user->hasPermissions([
            'admin.panel.forms'
        ]);
    }

    /**
     * Determine whether the user can delete the form.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Forms\Form  $form
     * @return mixed
     */
    public function delete(User $user, Form $form)
    {
        return $user->hasPermissions([
            'admin.panel.forms'
        ]);
    }
}
