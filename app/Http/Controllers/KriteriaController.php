<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KriteriaModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class KriteriaController extends Controller
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
        
        $data['page'] = "m_kriteria";
        $data['list'] = KriteriaModel::where('periode_id', $periode->periode_id)->get();
        return view('kriteria.index', $data);
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

        $data['page'] = "m_kriteria";
        return view('kriteria.tambah', $data);
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
            'keterangan' => 'required',
            'kriteria_kode' => 'required',
            'bobot' => 'required',
            'jenis' => 'required'
        ]);

        $data = [
            'periode_id' => $request->periode_id,
            'keterangan' => $request->keterangan,
            'kriteria_kode' => $request->kriteria_kode,
            'bobot' => $request->bobot,
            'jenis' => $request->jenis
        ];

        $result = KriteriaModel::create($data);

        if ($result) {
            $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            return redirect()->route('Kriteria');
        } else {
            $request->session()->flash('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
            return redirect()->route('Kriteria/tambah');
        }
    }

    public function edit($kriteria_id)
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

        $data['page'] = "m_kriteria";
        $data['kriteria'] = KriteriaModel::findOrFail($kriteria_id);
        return view('kriteria.edit', $data);
    }

    public function update(Request $request, $kriteria_id)
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
            'keterangan' => 'required',
            'kriteria_kode' => 'required',
            'bobot' => 'required',
            'jenis' => 'required'
        ]);

        $data = [
            'keterangan' => $request->keterangan,
            'kriteria_kode' => $request->kriteria_kode,
            'bobot' => $request->bobot,
            'jenis' => $request->jenis
        ];

        $m_kriteria = KriteriaModel::findOrFail($kriteria_id);
        $m_kriteria->update($data);

        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect()->route('Kriteria');
    }

    public function destroy(Request $request, $kriteria_id)
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

        KriteriaModel::findOrFail($kriteria_id)->delete();        
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect()->route('Kriteria');
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();

        $spreadsheet = IOFactory::load($path);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheetData as $key => $value) {
            if ($key != 0) {
                KriteriaModel::create([
                    'periode_id' => $value[0],
                    'keterangan' => $value[1],
                    'kriteria_kode' => $value[2],
                    'bobot' => $value[3],
                    'jenis' => $value[4],
                ]);
            }
        }

        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupload!</div>');
        return redirect('Kriteria');
    }
}
