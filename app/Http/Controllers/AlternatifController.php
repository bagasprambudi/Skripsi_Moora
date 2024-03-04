<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlternatifModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AlternatifController extends Controller
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

        $data['page'] = "m_alternatif";
        $data['list'] = AlternatifModel::where('periode_id', $periode->periode_id)->get();
        return view('Alternatif.index', $data);
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

        $data['page'] = "m_alternatif";
        return view('Alternatif.tambah', $data);
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
            'alternatif_nama' => 'required',
            'alternatif_alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
        ]);

        $data = [
            'periode_id' => $request->periode_id,
            'alternatif_nama' => $request->alternatif_nama,
            'alternatif_alamat' => $request->alternatif_alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
        ];

        $result = AlternatifModel::create($data);

        if ($result) {
            $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            return redirect('Alternatif');
        } else {
            $request->session()->flash('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
            return redirect('Alternatif/tambah');
        }
    }

    public function edit($alternatif_id)
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
        $data['alternatif'] = AlternatifModel::findOrFail($alternatif_id);
        return view('Alternatif.edit', $data);
    }

    public function update(Request $request, $alternatif_id)
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
            'alternatif_nama' => 'required',
            'alternatif_alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
        ]);

        $data = [
            'alternatif_nama' => $request->alternatif_nama,
            'alternatif_alamat' => $request->alternatif_alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
        ];

        $m_alternatif = AlternatifModel::findOrFail($alternatif_id);
        $m_alternatif->update($data);

        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect('Alternatif');
    }

    public function destroy(Request $request, $alternatif_id)
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
        
        AlternatifModel::findOrFail($alternatif_id)->delete();
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect('Alternatif');
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
                AlternatifModel::create([
                    'periode_id' => $value[0],
                    'alternatif_nama' => $value[1],
                    'alternatif_alamat' => $value[2],
                    'rt' => $value[3],
                    'rw' => $value[4],
                ]);
            }
        }

        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupload!</div>');
        return redirect('Alternatif');
    }
}
