<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppiu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kab_kota()
    {
        return $this->belongsTo(Kab_kota::class, 'id_kab_kota');
    }

    public function pengawasans()
    {
        return $this->hasMany(Pengawasan::class, 'id_ppiu');
    }

    public function akreditasi()
    {
        return $this->belongsTo(Akreditasi::class, 'id_akreditasi');
    }
}
