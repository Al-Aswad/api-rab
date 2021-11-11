<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{

    protected $fillable = [
        'bidang_id',
        'nama_kegiatan',
    ];

    protected $table = "kegiatan";
}
