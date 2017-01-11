<?php

namespace App\Policies;

use App\Models\Finances\Finance;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FinancePolicy
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
     * Determine whether the user can view the finance.
     *
     * @param  \App\Models\Users\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermissions([
            'admin.finances',
            'admin.finances.view'
        ]);
    }

    /**
     * Determine whether the user can create finances.
     *
     * @param  \App\Models\Users\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissions([
            'admin.finances'
        ]);
    }

    /**
     * Determine whether the user can update the finance.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Finances\Finance  $finance
     * @return mixed
     */
    public function update(User $user, Finance $finance)
    {
        return $user->hasPermissions([
            'admin.finances'
        ]);
    }

    /**
     * Determine whether the user can delete the finance.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Finances\Finance  $finance
     * @return mixed
     */
    public function delete(User $user, Finance $finance)
    {
        return $user->hasPermissions([
            'admin.finances'
        ]);
    }
}
