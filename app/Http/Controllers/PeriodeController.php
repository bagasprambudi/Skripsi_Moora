<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodeModel;

class PeriodeController extends Controller
{
    public function index()
    {
        $data['page'] = "m_periode";
        $data['list'] = PeriodeModel::all();
        
        return view('periode.index', $data);
    }

    public function tambah()
    {
        $data['page'] = "m_periode";
        return view('Periode.tambah', $data);
    }

    public function simpan(Request $request)
    {
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
        $data['page'] = "m_alternatif";
        $data['periode'] = PeriodeModel::findOrFail($periode_id);
        return view('Periode.edit', $data);
    }

    public function update(Request $request, $periode_id)
    {
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
        PeriodeModel::findOrFail($periode_id)->delete();
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect('Periode');
    }

    public function aktifkan(Request $request){
        $periode = PeriodeModel::find($request->periode_id);

        if ($periode){
            PeriodeModel::where('is_active', 1)->update(['is_active' => 0]);

            $periode->update(['is_active' => 1]);
            session()->put('periode', $periode);
        }

        return redirect()->back();
    }
}
