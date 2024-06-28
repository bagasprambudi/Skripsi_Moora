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
        // Mengambil semua input dari form
        $input = $request->all();
        unset($input['_token']);
    
        // Mengambil semua ID yang dicentang
        $isActive = $request->input('is_active', []);
    
        // Memproses setiap hasil yang dicentang
        foreach ($isActive as $id => $value) {
            // Update database untuk ID yang dicentang
            DB::table('t_hasil')->where('hasil_id', $id)->update(['is_active' => 1]);
        }
    
        // Mengambil semua hasil_id dari database
        $allIds = DB::table('t_hasil')->pluck('hasil_id')->toArray();
    
        // Mengatur is_active ke 0 untuk checkbox yang tidak dicentang
        foreach ($allIds as $id) {
            if (!array_key_exists($id, $isActive)) {
                DB::table('t_hasil')->where('hasil_id', $id)->update(['is_active' => 0]);
            }
        }
    
        // Flash message dan redirect
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
        return redirect()->route('Penerima');
    }
    
}
