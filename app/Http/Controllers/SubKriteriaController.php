<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubKriteriaModel;
use App\Models\KriteriaModel;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $periode = session()->get('periode');
        $user_level_id = session('log.user_level_id');
        
        if ($user_level_id != 1) {
            ?>
            <script>
                window.location='<?php echo url("Dashboard"); ?>'
                alert('Anda tidak berhak mengakses halaman ini!');
            </script>
            <?php
        }

        $data['page'] = "Sub Kriteria";
        $data['kriteria'] = KriteriaModel::where('periode_id', $periode->periode_id)->get();
        return view('sub_kriteria.index', $data);
    }

    public function simpan(Request $request)
    {
        $user_level_id = session('log.user_level_id');
        
        if ($user_level_id != 1) {
            ?>
            <script>
                window.location='<?php echo url("Dashboard"); ?>'
                alert('Anda tidak berhak mengakses halaman ini!');
            </script>
            <?php
        }

        $this->validate($request, [
            'periode_id' => 'required',
            'kriteria_id' => 'required',
            'deskripsi' => 'required',
            'nilai' => 'required'
        ]);

        $data = [
            'periode_id' => $request->periode_id,
            'kriteria_id' => $request->kriteria_id,
            'deskripsi' => $request->deskripsi,
            'nilai' => $request->nilai
        ];

        $result = SubKriteriaModel::create($data);

        if ($result) {
            $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            return redirect('SubKriteria');
        } else {
            $request->session()->flash('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
            return redirect('SubKriteria');
        }
    }

    public function edit(Request $request, $sub_kriteria_id)
    {
        $user_level_id = session('log.user_level_id');
        
        if ($user_level_id != 1) {
            ?>
            <script>
                window.location='<?php echo url("Dashboard"); ?>'
                alert('Anda tidak berhak mengakses halaman ini!');
            </script>
            <?php
        }

        $this->validate($request, [
            'periode_id' => 'required',
            'kriteria_id' => 'required',
            'deskripsi' => 'required',
            'nilai' => 'required'
        ]);

        $data = [
            'periode_id' => $request->periode_id,
            'kriteria_id' => $request->kriteria_id,
            'deskripsi' => $request->deskripsi,
            'nilai' => $request->nilai
        ];

        $m_subkriteria = SubKriteriaModel::findOrFail($sub_kriteria_id);
        $m_subkriteria->update($data);

        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect('SubKriteria');
    }

    public function destroy(Request $request, $sub_kriteria_id)
    {
        $user_level_id = session('log.user_level_id');
        
        if ($user_level_id != 1) {
            ?>
            <script>
                window.location='<?php echo url("Dashboard"); ?>'
                alert('Anda tidak berhak mengakses halaman ini!');
            </script>
            <?php
        }
        
        SubKriteriaModel::findOrFail($sub_kriteria_id)->delete();
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect('SubKriteria');
    }
}
