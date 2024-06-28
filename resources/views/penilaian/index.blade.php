@php
$periode = session()->get('periode');
@endphp

@include('layouts.header_admin')

{!! session('message') !!}

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Daftar Data Penilaian</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-info text-white">
                    <tr align="center">
                        <th width="5%">No</th>
                        <th>Nama Penerima</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>RW</th>
                        <th>RT</th>
                        @foreach ($kriteria as $keys)
                        <th style="width: 150px;">{{ $keys->keterangan }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($alternatif as $keys)
                    <tr align="center">
                        <td>{{ $no }}</td>
                        <td align="left">{{ $keys->alternatif_nama }}</td>
                        <td>{{ $keys->alternatif_nik }}</td>
                        <td class="text-left">{{ $keys->alternatif_alamat }}</td>
                        <td>{{ $keys->RT }}</td>
                        <td>{{ $keys->RW }}</td>
                        @foreach ($kriteria as $value)
                        <?php 
                            $nilai = \App\Models\PenilaianModel::data_penilaian($keys->alternatif_id, $value->kriteria_id);
                            $sub_kriteria = \App\Models\SubKriteriaModel::data_sub_kriteria($value->kriteria_id);
                        ?>    
                        <td style="width: 150px;">
                            <form action="{{ url('Penilaian/edit') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="alternatif_id" value="{{ $keys->alternatif_id }}">
                                <input type="hidden" name="kriteria_id" value="{{ $value->kriteria_id }}">
                                <input type="hidden" name="periode_id" value="{{ $periode->periode_id }}">
                                <select style="width: 200px;" name="nilai" class="form-control" onchange="this.form.submit()" required>
                                    <option value="">--Pilih--</option>
                                    @foreach ($sub_kriteria as $subs_kriteria)
                                        <option value="{{ $subs_kriteria['sub_kriteria_id'] }}" {{ $nilai && $subs_kriteria['sub_kriteria_id'] == $nilai->nilai ? 'selected' : '' }}>{{ $subs_kriteria['deskripsi'] }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </td>     
                        @endforeach 
                    </tr>
                    <?php $no++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('layouts.footer_admin')
