<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodeModel;

class PeriodeController extends Controller
{
    public function index()
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

        $data['page'] = "Periode";
        $data['list'] = PeriodeModel::all();
        
        return view('periode.index', $data);
    }

    public function tambah()
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

        $data['page'] = "m_periode";
        return view('Periode.tambah', $data);
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
            'periode_nama' => 'required',
            'is_active' => 'required'
        ]);

        $data = [
            'periode_id' => $request->periode_id,
            'periode_nama' => $request->periode_nama,
            'is_active' => $request->is_active
        ];

        $result = PeriodeModel::create($data);

        if ($result) {
            $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            return redirect('Periode');
        } else {
            $request->session()->flash('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
            return redirect('Periode');
        }
    }

    public function edit($periode_id)
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

        $data['page'] = "m_alternatif";
        $data['periode'] = PeriodeModel::findOrFail($periode_id);
        return view('Periode.edit', $data);
    }

    public function update(Request $request, $periode_id)
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
            'periode_nama' => 'required',
            'is_active' => 'required'
        ]);

        $data = [
            'periode_id' => $request->periode_id,
            'periode_nama' => $request->periode_nama,
            'is_active' => $request->is_active
        ];

        $m_periode = PeriodeModel::findOrFail($periode_id);
        $m_periode->update($data);

        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect('Periode');
    }

    public function destroy(Request $request, $periode_id)
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
        
        PeriodeModel::findOrFail($periode_id)->delete();
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect('Periode');
    }
}
