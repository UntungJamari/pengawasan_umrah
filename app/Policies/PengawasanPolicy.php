<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pengawasan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengawasanPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        return $user->level == 'ppiu';
    }

    public function show(User $user, Pengawasan $pengawasan)
    {
        if ($user->level == 'kanwil') {
            return true;
        } elseif ($user->level == 'kab/kota') {
            return $user->kemenag_kab_kota->id_kab_kota == $pengawasan->ppiu->id_kab_kota;
        } elseif ($user->level == 'ppiu') {
            return $user->ppiu->id == $pengawasan->id_ppiu;
        }
    }

    public function update(User $user, Pengawasan $pengawasan)
    {
        if ($user->level == 'ppiu') {
            return $user->ppiu->id == $pengawasan->id_ppiu;
        } else {
            return false;
        }
    }

    public function destroy(User $user, Pengawasan $pengawasan)
    {
        if ($user->level == 'ppiu') {
            return $user->ppiu->id == $pengawasan->id_ppiu;
        } else {
            return false;
        }
    }
}
