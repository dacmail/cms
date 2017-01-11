<?php

namespace App\Policies;

use App\Models\Partners\Partner;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartnerPolicy
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
     * Determine whether the user can view the partner.
     *
     * @param  \App\Models\Users\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.partners',
            'admin.panel.partners.view'
        ]);
    }

    /**
     * Determine whether the user can create partners.
     *
     * @param  \App\Models\Users\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.partners'
        ]);
    }

    /**
     * Determine whether the user can update the partner.
     *
     * @param  \App\Models\Users\User $user
     * @param \App\Models\Partners\Partner|Partner $partner
     * @return mixed
     */
    public function update(User $user, Partner $partner)
    {
        return $user->hasPermissions([
            'admin.panel.partners'
        ]);
    }

    /**
     * Determine whether the user can delete the partner.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Partners\Partner  $partner
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.partners'
        ]);
    }
}
