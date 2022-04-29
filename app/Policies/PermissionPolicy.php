<?php

namespace App\Policies;

use App\Permission;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if(
            $user->roles->contains('name','admin') && $user->permissions->contains('name','permission_show') ||
            $user->roles->contains('name','user') && $user->permissions->contains('name','permission_show') ||
            $user->roles->contains('name','user_viewer') && $user->permissions->contains('name','permission_show')
        )
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function view(User $user)
    {
        if(
            $user->roles->contains('name','admin')
        )
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if(
            $user->roles->contains('name','admin')
        )
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function update(User $user, Permission $permission)
    {
        if(
            $user->roles->contains('name','admin')
        )
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function delete(User $user, Permission $permission)
    {
        if(
            $user->roles->contains('name','admin')
        )
        return true;
    }
}