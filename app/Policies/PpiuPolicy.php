<?php

namespace App\Policies;

use App\Models\Ppiu;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Auth\Access\HandlesAuthorization;

class PpiuPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->level != 'ppiu';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ppiu  $ppiu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Ppiu $ppiu)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->level != 'ppiu';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ppiu  $ppiu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Ppiu $ppiu)
    {
        if ($user->level == 'kab/kota') {
            return $user->kemenag_kab_kota->id_kab_kota == $ppiu->id_kab_kota;
        } elseif ($user->level == 'kanwil') {
            return true;
        } elseif ($user->level == 'ppiu') {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ppiu  $ppiu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Ppiu $ppiu)
    {
        if ($user->level == 'kab/kota') {
            return $user->kemenag_kab_kota->id_kab_kota == $ppiu->id_kab_kota;
        } elseif ($user->level == 'kanwil') {
            return true;
        } elseif ($user->level == 'ppiu') {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ppiu  $ppiu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Ppiu $ppiu)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ppiu  $ppiu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Ppiu $ppiu)
    {
        //
    }

    public function resetPassword(User $user, Ppiu $ppiu)
    {
        if ($user->level == 'kab/kota') {
            return $user->kemenag_kab_kota->id_kab_kota == $ppiu->id_kab_kota;
        } elseif ($user->level == 'kanwil') {
            return true;
        }
    }
}
