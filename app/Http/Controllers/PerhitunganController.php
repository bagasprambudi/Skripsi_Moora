<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerhitunganModel;
use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use Illuminate\Support\Facades\DB;

class PerhitunganController extends Controller
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

        $data['page'] = "Perhitungan";
        $data['alternatifs'] = AlternatifModel::where('periode_id', $periode->periode_id)->get();
        $data['kriterias'] = KriteriaModel::all();
        return view('perhitungan.index', $data);
    }
}
