<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginModel;
use App\Models\PeriodeModel;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function proses_login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $passwordx = md5($password);

        $loginModel = new LoginModel();
        $set = $loginModel->login($username, $passwordx);

        $periode = PeriodeModel::where('is_active', 1)->selectRaw('periode_id, periode_nama')->first();

        if ($set) {
            $log = [
                'user_id' => $set->user_id,
                'username' => $set->username,
                'nama' => $set->nama,
                'user_level_id' => $set->user_level_id,
                'status' => 'Logged'
            ];

            session()->put('log', $log);
            session()->put('periode', $periode);

            return redirect()->route('dashboard');
        } else {
            $request->session()->flash('message', 'Username atau Password Salah');
            return redirect()->route('login');
        }
    }


    public function Logout(Request $request) // Renamed the method to lowercase "logout"
    {
        $request->session()->flush();
        return redirect()->route('login');
    }

    public function Dashboard() // Renamed the method to lowercase "dashboard"
    {
        if (session('log.status') == 'Logged') {
            $data['page'] = "Dashboard";
            return view('dashboard', $data);
        } else {
            return redirect()->route('login');
        }
    }
}
