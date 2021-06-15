<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BusCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the busCategory can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list buscategories');
    }

    /**
     * Determine whether the busCategory can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusCategory  $model
     * @return mixed
     */
    public function view(User $user, BusCategory $model)
    {
        return $user->hasPermissionTo('view buscategories');
    }

    /**
     * Determine whether the busCategory can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create buscategories');
    }

    /**
     * Determine whether the busCategory can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusCategory  $model
     * @return mixed
     */
    public function update(User $user, BusCategory $model)
    {
        return $user->hasPermissionTo('update buscategories');
    }

    /**
     * Determine whether the busCategory can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusCategory  $model
     * @return mixed
     */
    public function delete(User $user, BusCategory $model)
    {
        return $user->hasPermissionTo('delete buscategories');
    }

    /**
     * Determine whether the busCategory can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusCategory  $model
     * @return mixed
     */
    public function restore(User $user, BusCategory $model)
    {
        return false;
    }

    /**
     * Determine whether the busCategory can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusCategory  $model
     * @return mixed
     */
    public function forceDelete(User $user, BusCategory $model)
    {
        return false;
    }
}
