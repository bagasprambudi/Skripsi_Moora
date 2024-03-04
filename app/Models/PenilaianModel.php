<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianModel extends Model
{
    protected $table = 't_penilaian';
    protected $primaryKey = 'penilaian_id';
    protected $fillable = ['periode_id', 'alternatif_id', 'kriteria_id', 'nilai'];
    public $timestamps = false;

    public static function untuk_tombol($alternatif_id, $kriteria_id)
    {
        return self::where('alternatif_id', $alternatif_id)->where('kriteria_id', $kriteria_id)->count();
    }

    public static function data_penilaian($alternatif_id, $kriteria_id)
    {
        return self::where('alternatif_id', $alternatif_id)->where('kriteria_id', $kriteria_id)->first();
    }

    public static function tambah_penilaian($periode_id, $alternatif_id, $kriteria_id, $nilai)
    {
        return self::insert([
            'periode_id' => $periode_id,
            'alternatif_id' => $alternatif_id,
            'kriteria_id' => $kriteria_id,
            'nilai' => $nilai,
        ]);
    }

    public static function edit_penilaian($periode_id, $alternatif_id, $kriteria_id, $nilai)
    {
        return self::where('periode_id', $periode_id)
            ->where('alternatif_id', $alternatif_id)
            ->where('kriteria_id', $kriteria_id)
            ->update(['nilai' => $nilai]);
    }
}
