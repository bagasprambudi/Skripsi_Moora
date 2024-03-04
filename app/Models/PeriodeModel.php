<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeModel extends Model
{
    protected $table = 'm_periode';
    protected $primaryKey = 'periode_id';
    protected $fillable = ['periode_id', 'periode_nama', 'is_active',];
    public $timestamps = false;

    public static function data_m_periode($periode_id)
    {
        return self::where('periode_id', $periode_id)->get();
    }
}

