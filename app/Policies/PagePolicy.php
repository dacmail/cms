<?php

namespace App\Policies;

use App\Models\Pages\Page;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
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
     * Determine whether the user can view the page.
     *
     * @param  \App\Models\Users\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.pages',
            'admin.panel.pages.view',
            'admin.panel.pages.crud'
        ]);
    }

    /**
     * Determine whether the user can create pages.
     *
     * @param  \App\Models\Users\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.pages',
            'admin.panel.pages.crud'
        ]);
    }

    /**
     * Determine whether the user can update the page.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Pages\Page  $page
     * @return mixed
     */
    public function update(User $user, Page $page)
    {
        return $user->hasPermissions([
            'admin.panel.pages',
            'admin.panel.pages.crud'
        ]);
    }

    /**
     * Determine whether the user can delete the page.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Pages\Page  $page
     * @return mixed
     */
    public function delete(User $user, Page $page)
    {
        return $user->hasPermissions([
            'admin.panel.pages',
            'admin.panel.pages.crud'
        ]);
    }
}
