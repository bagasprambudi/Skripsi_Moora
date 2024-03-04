<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PerhitunganModel extends Model
{
    protected $table = 't_penilaian';
    protected $primaryKey = 'penilaian_id';
    protected $fillable = ['alternatif_id', 'kriteria_id', 'nilai'];
    public $timestamps = false;

    public static function data_nilai($alternatif_id, $kriteria_id)
    {
        return self::join('m_sub_kriteria', 't_penilaian.nilai', '=', 'm_sub_kriteria.sub_kriteria_id')
            ->where('t_penilaian.alternatif_id', $alternatif_id)
            ->where('t_penilaian.kriteria_id', $kriteria_id)
            ->first();
    }

    public static function hapus_hasil()
    {
        DB::table('t_hasil')->truncate();
        return true;
    }

    public static function get_hasil()
    {
        return DB::table('t_hasil')
            ->join('m_alternatif', 't_hasil.alternatif_id', '=', 'm_alternatif.alternatif_id')
            ->orderBy('nilai', 'DESC')
            ->get();
    }
}
