<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserModel;
use App\Models\PeriodeModel;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('d_user_level')->insert([
            'user_level_id' => 1,
            'user_level' => 'Administrator'
        ]);

        DB::table('d_user_level')->insert([
            'user_level_id' => 2,
            'user_level' => 'User'
        ]);

        UserModel::insert([
            'user_level_id' => 1,
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => '21232f297a57a5a743894a0e4a801fc3'
        ]);
    }
}
