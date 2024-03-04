<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KriteriaModel extends Model
{
    protected $table = 'm_kriteria';
    protected $primaryKey = 'kriteria_id';
    protected $fillable = ['periode_id', 'keterangan', 'kriteria_kode', 'bobot', 'jenis'];
    public $timestamps = false;
}
