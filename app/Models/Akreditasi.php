<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akreditasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ppiu()
    {
        return $this->hasOne(Ppiu::class, 'id_akreditasi');
    }
}
