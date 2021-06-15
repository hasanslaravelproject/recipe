<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SeatClass;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeatClassPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the seatClass can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list seatclasses');
    }

    /**
     * Determine whether the seatClass can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SeatClass  $model
     * @return mixed
     */
    public function view(User $user, SeatClass $model)
    {
        return $user->hasPermissionTo('view seatclasses');
    }

    /**
     * Determine whether the seatClass can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create seatclasses');
    }

    /**
     * Determine whether the seatClass can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SeatClass  $model
     * @return mixed
     */
    public function update(User $user, SeatClass $model)
    {
        return $user->hasPermissionTo('update seatclasses');
    }

    /**
     * Determine whether the seatClass can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SeatClass  $model
     * @return mixed
     */
    public function delete(User $user, SeatClass $model)
    {
        return $user->hasPermissionTo('delete seatclasses');
    }

    /**
     * Determine whether the seatClass can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SeatClass  $model
     * @return mixed
     */
    public function restore(User $user, SeatClass $model)
    {
        return false;
    }

    /**
     * Determine whether the seatClass can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SeatClass  $model
     * @return mixed
     */
    public function forceDelete(User $user, SeatClass $model)
    {
        return false;
    }
}
