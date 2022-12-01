<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kemenag_kab_kota extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(Kab_kota::class, 'id_user');
    }

    public function kab_kota()
    {
        return $this->belongsTo(Kab_kota::class, 'id_kab_kota');
    }
}
