<?php

namespace App\Policies;

use App\Models\Bus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the bus can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list buses');
    }

    /**
     * Determine whether the bus can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bus  $model
     * @return mixed
     */
    public function view(User $user, Bus $model)
    {
        return $user->hasPermissionTo('view buses');
    }

    /**
     * Determine whether the bus can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create buses');
    }

    /**
     * Determine whether the bus can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bus  $model
     * @return mixed
     */
    public function update(User $user, Bus $model)
    {
        return $user->hasPermissionTo('update buses');
    }

    /**
     * Determine whether the bus can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bus  $model
     * @return mixed
     */
    public function delete(User $user, Bus $model)
    {
        return $user->hasPermissionTo('delete buses');
    }

    /**
     * Determine whether the bus can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bus  $model
     * @return mixed
     */
    public function restore(User $user, Bus $model)
    {
        return false;
    }

    /**
     * Determine whether the bus can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Bus  $model
     * @return mixed
     */
    public function forceDelete(User $user, Bus $model)
    {
        return false;
    }
}
