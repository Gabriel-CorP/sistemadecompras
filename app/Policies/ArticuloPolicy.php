<?php

namespace App\Policies;

use App\Models\Articulo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticuloPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Articulo  $articulo
     * @return mixed
     */
    public function view(User $user, Articulo $articulo)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Articulo  $articulo
     * @return mixed
     */
    public function update(User $user, Articulo $articulo)
    {
        //revisa si el usuario autenticado es quien creo el articulo
        return $user->id === $articulo->user_id;   
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Articulo  $articulo
     * @return mixed
     */
    public function delete(User $user, Articulo $articulo)
    {
        return $user->id === $articulo->user_id;   
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Articulo  $articulo
     * @return mixed
     */
    public function restore(User $user, Articulo $articulo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Articulo  $articulo
     * @return mixed
     */
    public function forceDelete(User $user, Articulo $articulo)
    {
        //
    }
}
