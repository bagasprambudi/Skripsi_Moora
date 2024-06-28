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

        $data['page'] = "m_sub_kriteria";
        $data['kriteria'] = KriteriaModel::where('periode_id', $periode->periode_id)->get();
        return view('sub_kriteria.index', $data);
    }

    public function simpan(Request $request)
    {
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
        SubKriteriaModel::findOrFail($sub_kriteria_id)->delete();
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect('SubKriteria');
    }
}
