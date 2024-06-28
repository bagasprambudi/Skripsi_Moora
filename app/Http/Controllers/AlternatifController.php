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

        $data['page'] = "m_alternatif";
        $data['list'] = AlternatifModel::where('periode_id', $periode->periode_id)->get();
        return view('Alternatif.index', $data);
    }

    public function tambah()
    {
        $data['page'] = "m_alternatif";
        return view('Alternatif.tambah', $data);
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'periode_id' => 'required',
            'alternatif_nama' => 'required',
            'alternatif_nik' => 'required|integer',
            'alternatif_alamat' => 'required',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
        ]);

        $data = [
            'periode_id' => $request->periode_id,
            'alternatif_nama' => $request->alternatif_nama,
            'alternatif_nik' => $request->alternatif_nik,
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
        $data['page'] = "m_alternatif";
        $data['alternatif'] = AlternatifModel::findOrFail($alternatif_id);
        return view('Alternatif.edit', $data);
    }

    public function update(Request $request, $alternatif_id)
    {
        $this->validate($request, [
            'alternatif_nama' => 'required',
            'alternatif_nik' => 'required|integer',
            'alternatif_alamat' => 'required',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
        ]);

        $data = [
            'alternatif_nama' => $request->alternatif_nama,
            'alternatif_nik' => $request->alternatif_nik,
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
                    'alternatif_nik' => $value[2],
                    'alternatif_alamat' => $value[3],
                    'rt' => $value[4],
                    'rw' => $value[5],
                ]);
            }
        }

        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupload!</div>');
        return redirect('Alternatif');
    }
}
