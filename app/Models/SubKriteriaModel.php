<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKriteriaModel extends Model
{
    protected $table = 'm_sub_kriteria';
    protected $primaryKey = 'sub_kriteria_id';
    protected $fillable = ['periode_id','kriteria_id', 'deskripsi', 'nilai'];
    public $timestamps = false;

    public static function data_sub_kriteria($kriteria_id)
    {
        return self::where('kriteria_id', $kriteria_id)->get();
    }
}
