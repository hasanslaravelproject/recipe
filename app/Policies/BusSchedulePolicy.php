<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BusSchedule;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusSchedulePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the busSchedule can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list busschedules');
    }

    /**
     * Determine whether the busSchedule can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusSchedule  $model
     * @return mixed
     */
    public function view(User $user, BusSchedule $model)
    {
        return $user->hasPermissionTo('view busschedules');
    }

    /**
     * Determine whether the busSchedule can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create busschedules');
    }

    /**
     * Determine whether the busSchedule can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusSchedule  $model
     * @return mixed
     */
    public function update(User $user, BusSchedule $model)
    {
        return $user->hasPermissionTo('update busschedules');
    }

    /**
     * Determine whether the busSchedule can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusSchedule  $model
     * @return mixed
     */
    public function delete(User $user, BusSchedule $model)
    {
        return $user->hasPermissionTo('delete busschedules');
    }

    /**
     * Determine whether the busSchedule can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusSchedule  $model
     * @return mixed
     */
    public function restore(User $user, BusSchedule $model)
    {
        return false;
    }

    /**
     * Determine whether the busSchedule can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusSchedule  $model
     * @return mixed
     */
    public function forceDelete(User $user, BusSchedule $model)
    {
        return false;
    }
}
