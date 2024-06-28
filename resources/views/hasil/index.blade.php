@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Perangkingan</h1>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Hasil Perankingan</h6>
    </div>

    <div class="card-body">
        <form action="{{ route('hasil.simpan') }}" method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-info text-white">
                        <tr align="center">
                            <th width="6%">No</th>
                            <th>Nama Penerima</th>
                            <th>NIK</th>
                            <th>Alamat</th>
                            <th>RW</th>
                            <th>RT</th>
                            <th>Nilai Akhir</th>
                            <th width="5%">Pilih</th> <!-- Kolom ceklis -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hasil as $keys)
                        <tr align="center">
                            <td>{{ $loop->iteration }}</td>
                            <td align="left">{{ $keys->alternatif_nama }}</td>
                            <td>{{ $keys->alternatif_nik }}</td>
                            <td class="text-left">{{ $keys->alternatif_alamat }}</td>
                            <td>{{ $keys->RT }}</td>
                            <td>{{ $keys->RW }}</td>
                            <td>{{ $keys->nilai }}</td>
                            <td>
                                <!-- <input type="hidden" name="hasil_id" value="{{ $keys->hasil_id }}"> -->
                                <input class="checkbox-custom" type="checkbox" name="is_active[{{ $keys->hasil_id }}]" value="1" {{ $keys->is_active ? 'checked' : '' }}>
                            </td> <!-- Checkbox -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Tombol Simpan -->
            <div class="text-right mt-3">
                <!-- Menambahkan onclick event handler untuk menampilkan konfirmasi -->
                <button type="submit" class="btn btn-success" onclick="return confirmSubmit()">
                    <i class="fa fa-save fa-lg"></i> Simpan
                </button>
            </div>

            <script>
            function confirmSubmit() {
            var confirmMessage = confirm("Apakah Data Yang Anda Pilih Sudah Sesuai Dengan Data Penerima Bantuan Sosial Desa Wonomerto?");
                if (confirmMessage) {
                // Pengguna mengklik OK, submit formulir
                return true;
                } else {
                // Pengguna mengklik Cancel, jangan submit formulir
                return false;
                }
            }
        </script>
        
        </form>
    </div>
</div>

@include('layouts.footer_admin')
