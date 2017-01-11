<?php

namespace App\Policies;

use App\Models\Users\User;
use App\Models\Calendar\Calendar;
use Illuminate\Auth\Access\HandlesAuthorization;

class CalendarPolicy
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
     * Determine whether the user can view the calendar.
     *
     * @param  \App\Models\Users\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermissions([
            'admin.calendar',
            'admin.calendar.view'
        ]);
    }

    /**
     * Determine whether the user can create calendar.
     *
     * @param  \App\Models\Users\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissions([
            'admin.calendar'
        ]);
    }

    /**
     * Determine whether the user can update the calendar.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Calendar\Calendar  $calendar
     * @return mixed
     */
    public function update(User $user, Calendar $calendar)
    {
        return $user->hasPermissions([
            'admin.calendar'
        ]);
    }

    /**
     * Determine whether the user can delete the calendar.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Calendar\Calendar  $calendar
     * @return mixed
     */
    public function delete(User $user, Calendar $calendar)
    {
        return $user->hasPermissions([
            'admin.calendar'
        ]);
    }
}
