<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenilaianModel;
use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use App\Models\PeriodeModel;

class PenilaianController extends Controller
{
    public function index()
    {
        $periode = session()->get('periode');
        // $user_level_id = session('log.user_level_id');
        
        // if ($user_level_id != 1) {
        //     ?>
        //     <script>
        //         window.location='<?php echo url("Dashboard"); ?>'
        //         alert('Anda tidak berhak mengakses halaman ini!');
        //     </script>
        //     <?php
        // }

        $data['page'] = "t_penilaian";
        $data['alternatif'] = AlternatifModel::where('periode_id', $periode->periode_id)->get();
        $data['kriteria'] = KriteriaModel::where('periode_id', $periode->periode_id)->get();
        return view('penilaian.index', $data);
    }

    public function tambah(Request $request)
    {
        $periode_id = $request->input('periode_id');
        $alternatif_id = $request->input('alternatif_id');
        $kriteria_id = $request->input('kriteria_id');
        $nilai = $request->input('nilai');
        PenilaianModel::tambah_penilaian($periode_id, $alternatif_id, $kriteria_id, $nilai);
        // $i = 0;
        // foreach ($nilai as $key) {
        //     $i++;
        // }
        session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
        return redirect('Penilaian');
    }

    public function edit(Request $request)
    {
        $periode_id = $request->periode_id;
        $alternatif_id = $request->input('alternatif_id');
        $kriteria_id = $request->input('kriteria_id');
        $nilai = $request->input('nilai');
        
        $cek = PenilaianModel::data_penilaian($alternatif_id, $kriteria_id);
        if (!$cek) {
            PenilaianModel::tambah_penilaian($periode_id, $alternatif_id, $kriteria_id, $nilai);
        } else {
            PenilaianModel::edit_penilaian($periode_id, $alternatif_id, $kriteria_id, $nilai);
        }
        // $i = 0;

        // foreach ($nilai as $key) {
        //     $i++;
        // }
        session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect('Penilaian');
    }
}
