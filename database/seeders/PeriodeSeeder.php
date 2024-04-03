<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_periode')->insert([
            [
                'periode_id' => 20231,
                'periode_nama' => "2023 - Januari s/d Februari",
                'is_active' => 0,
            ],

            [
                'periode_id' => 20232,
                'periode_nama' => "2023 - April s/d Mei",
                'is_active' => 0,
            ],

            [
                'periode_id' => 20233,
                'periode_nama' => "2023 - Juli s/d Agustus",
                'is_active' => 0,
            ],

            [
                'periode_id' => 20234,
                'periode_nama' => "2023 - Oktober s/d November",
                'is_active' => 0,
            ],
            [
                'periode_id' => 20241,
                'periode_nama' => "2023 - Januari s/d Februari",
                'is_active' => 1,
            ],
        ]);
    }
}