<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaController extends Controller
{
    public function index()
    {
        $data['page'] = "t_Penerima";
        $data['hasil'] = DB::table('t_hasil')
        ->join('m_alternatif', 't_hasil.alternatif_id', '=', 'm_alternatif.alternatif_id')
        ->where('is_active', 1)
        ->orderBy('nilai', 'DESC')
        ->get();
        return view('penerima.index', $data);
    }
}
