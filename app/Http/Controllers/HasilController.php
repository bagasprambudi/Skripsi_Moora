<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerhitunganModel;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;

class HasilController extends Controller
{
    public function index()
    {
        $data['page'] = "t_hasil";
        $data['hasil'] = PerhitunganModel::get_hasil();
        return view('hasil.index', $data);
    }
    public function Laporan()
    {
        $data['hasil'] = DB::table('t_hasil')
        ->join('m_alternatif', 't_hasil.alternatif_id', '=', 'm_alternatif.alternatif_id')
        ->where('is_active', 1)
        ->orderBy('nilai', 'DESC')
        ->get();

        // Membuat objek Dompdf
        $pdf = new Dompdf();

        // Menyiapkan konten HTML untuk PDF
        $html = view('penerima.laporan', [
            'hasil' => $data['hasil'], // Pass $hasil to the view
        ])->render();

        // Memuat konten HTML ke Dompdf
        $pdf->loadHtml($html);

        // Rendering PDF
        $pdf->render();

        // Mengirimkan PDF sebagai unduhan
        // return $pdf->stream('laporan.pdf');
        // Mengambil output PDF
        $output = $pdf->output();

        // Menampilkan PDF di browser
        header('Content-Type: application/pdf');
        echo $output;
    }

    public function simpan(Request $request){
        $result = false;

        // Mengiterasi melalui semua input yang dikirimkan
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'is_active_') === 0) {
                $id = str_replace('is_active_', '', $key);
                $isActive = $value == '1' ? true : false;

                $result = DB::table('t_hasil')->where('hasil_id', $id)->update(['is_active' => $isActive]);
            }
        }


        if ($result) {
            $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            return redirect()->route('Penerima');
        } else {
            $request->session()->flash('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
            return redirect()->route('Hasil');
        }
    }
}
