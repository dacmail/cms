<?php

namespace App\Policies;

use App\Models\Posts\Post;
use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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
     * Determine whether the user can view the post.
     *
     * @param  \App\Models\Users\User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.posts',
            'admin.panel.posts.view',
            'admin.panel.posts.crud'
        ]);
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\Models\Users\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissions([
            'admin.panel.posts',
            'admin.panel.posts.crud'
        ]);
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Posts\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return $user->hasPermissions([
            'admin.panel.posts',
            'admin.panel.posts.crud'
        ]);
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\Models\Users\User $user
     * @param  \App\Models\Posts\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        return $user->hasPermissions([
            'admin.panel.posts',
            'admin.panel.posts.crud'
        ]);
    }
}
