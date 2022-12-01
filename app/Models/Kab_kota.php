<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kab_kota extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kemenag_kab_kota()
    {
        return $this->hasOne(Kemenag_kab_kota::class, 'id_kab_kota');
    }

    public function ppius()
    {
        return $this->hasMany(Ppiu::class, 'id_kab_kota');
    }
}
