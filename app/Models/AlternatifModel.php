<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlternatifModel extends Model
{
    protected $table = 'm_alternatif';
    protected $primaryKey = 'alternatif_id';
    protected $fillable = ['periode_id','alternatif_nama', 'alternatif_nik','alternatif_alamat','rt','rw'];
    public $timestamps = false;
}
