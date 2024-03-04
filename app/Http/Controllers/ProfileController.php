<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class ProfileController extends Controller
{
    public function index()
    {
        $user_id = session('log.user_id');
        $data['page'] = "Profile";
        $data['profile'] = UserModel::findOrFail($user_id);
        return view('profile.index', $data);
    }

    public function update(Request $request, $user_id)
    {
        $this->validate($request, [
            'email' => 'required',
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'email' => $request->input('email'),
            'nama' => $request->input('nama'),
            'username' => $request->input('username'),
            'password' => md5($request->input('password'))
        ];

        $user = UserModel::findOrFail($user_id);
        $user->update($data);

        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data profile berhasil diupdate!</div>');
        return redirect('Profile');
    }

}
