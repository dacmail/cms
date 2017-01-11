<?php

namespace App\Policies;

use App\Models\Files\File;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
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
     * Determine whether the user can view the file.
     *
     * @param  \App\Models\Users\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.files',
            'admin.panel.files.view'
        ]);
    }

    /**
     * Determine whether the user can create files.
     *
     * @param  \App\Models\Users\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.files'
        ]);
    }

    /**
     * Determine whether the user can update the file.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Files\File  $file
     * @return mixed
     */
    public function update(User $user, File $file)
    {
        return $user->hasPermissions([
            'admin.panel.files'
        ]);
    }

    /**
     * Determine whether the user can delete the file.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Files\File  $file
     * @return mixed
     */
    public function delete(User $user, File $file)
    {
        return $user->hasPermissions([
            'admin.panel.files'
        ]);
    }
}
