<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class UserController extends Controller
{
    public function index()
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

        $data['page'] = "d_user";
        $data['list'] = UserModel::get_user();
        return view('user.index', $data);
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

        $data['page'] = "d_user";
        $data['user_level'] = UserModel::get_user_level();
        return view('user.tambah', $data);
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
            'nama' => 'required',
            'email' => 'required|unique:d_user,email',
            'privilege' => 'required',
            'username' => 'required|unique:d_user,username',
            'password' => 'required',
        ]);

        $data = [
            'user_level_id' => $request->input('privilege'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => md5($request->input('password'))
        ];

        $result = UserModel::create($data);

        if ($result) {
            $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            return redirect('User');
        } else {
            $request->session()->flash('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
            return redirect('User/tambah');
        }
    }

    public function edit($user_id)
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

        $data['page'] = "d_user";
        $data['user_level'] = UserModel::get_user_level();
        $data['user'] = UserModel::findOrFail($user_id);
        return view('user.edit', $data);
    }

    public function detail($user_id)
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

        $data['page'] = "d_user";
        $data['user_level'] = UserModel::get_user_level();
        $data['user'] = UserModel::findOrFail($user_id);
        return view('user.detail', $data);
    }

    public function update(Request $request, $user_id)
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
            'nama' => 'required',
            'email' => 'required',
            'privilege' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'user_level_id' => $request->input('privilege'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => md5($request->input('password'))
        ];

        $d_user = UserModel::findOrFail($user_id);
        $d_user->update($data);

        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect('User');
    }

    public function destroy(Request $request, $user_id)
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
        
        UserModel::findOrFail($user_id)->delete();
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect('User');
    }

}
