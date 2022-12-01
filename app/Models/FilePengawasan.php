<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilePengawasan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pengawasan()
    {
        return $this->belongsTo(Pengawasan::class, 'id_pengawasan');
    }
}
