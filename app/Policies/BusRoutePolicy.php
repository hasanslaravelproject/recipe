<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BusRoute;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusRoutePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the busRoute can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list busroutes');
    }

    /**
     * Determine whether the busRoute can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusRoute  $model
     * @return mixed
     */
    public function view(User $user, BusRoute $model)
    {
        return $user->hasPermissionTo('view busroutes');
    }

    /**
     * Determine whether the busRoute can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create busroutes');
    }

    /**
     * Determine whether the busRoute can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusRoute  $model
     * @return mixed
     */
    public function update(User $user, BusRoute $model)
    {
        return $user->hasPermissionTo('update busroutes');
    }

    /**
     * Determine whether the busRoute can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusRoute  $model
     * @return mixed
     */
    public function delete(User $user, BusRoute $model)
    {
        return $user->hasPermissionTo('delete busroutes');
    }

    /**
     * Determine whether the busRoute can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusRoute  $model
     * @return mixed
     */
    public function restore(User $user, BusRoute $model)
    {
        return false;
    }

    /**
     * Determine whether the busRoute can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusRoute  $model
     * @return mixed
     */
    public function forceDelete(User $user, BusRoute $model)
    {
        return false;
    }
}
