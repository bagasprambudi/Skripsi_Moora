@php
$periode = session()->get('periode');
@endphp

@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Data Penilaian</h1>
</div>

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
                        <th>Alamat</th>
                        <th>RW</th>
                        <th>RT</th>
                        @foreach ($kriteria as $keys)
                        <td>{{ $keys->keterangan }}</td>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($alternatif as $keys)
                    <tr align="center">
                        <td>{{ $no }}</td>
                        <td align="left">{{ $keys->alternatif_nama }}</td>
                        <td class="text-left">{{ $keys->alternatif_alamat }}</td>
                        <td>{{ $keys->RT }}</td>
                        <td>{{ $keys->RW }}</td>
                        @foreach ($kriteria as $value)
                        <?php $cek_tombol = \App\Models\PenilaianModel::untuk_tombol($keys->alternatif_id, $value->kriteria_id); ?>    
                        <td>
                           @if ($cek_tombol == 0)
                            <a data-toggle="modal" href="#set{{ $value->kriteria_id }}{{ $keys->alternatif_id }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Input</a>
                            @else
                            <a data-toggle="modal" href="#edit{{ $value->kriteria_id }}{{ $keys->alternatif_id }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                           @endif
                        </td>     
                        @endforeach 
                    </tr>

               
                    @foreach ($kriteria as $value)
                    <!-- Modal -->
                    <div class="modal fade" id="set{{ $value->kriteria_id }}{{ $keys->alternatif_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Input Penilaian</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <form action="{{ url('Penilaian/tambah') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="modal-body">

                                        @foreach ($kriteria as $key)
                                            @php
                                            $modalId = $value->kriteria_id
                                            @endphp

                                            @if($modalId == $key->kriteria_id)

                                            @php
                                            $sub_kriteria = \App\Models\SubKriteriaModel::data_sub_kriteria($key->kriteria_id);
                                            @endphp
                                            @if ($sub_kriteria != NULL)
                                                <input type="hidden" name="alternatif_id" value="{{ $keys->alternatif_id }}">
                                                <input type="hidden" name="kriteria_id" value="{{ $key->kriteria_id }}">
                                                <div class="form-group">
                                                <label for="periode_id" class="font-weight-bold">Periode</label>
                                                <input autocomplete="off" readonly type="text" id="periode_id" class="form-control" name="periode_id" value="{{ $periode->periode_id }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="{{ $key->kriteria_id }}">{{ $key->keterangan }}</label>
                                                    <select name="nilai" class="form-control" id="{{ $key->kriteria_id }}" required>
                                                        <option value="">--Pilih--</option>
                                                        @foreach ($sub_kriteria as $subs_kriteria)
                                                            <option value="{{ $subs_kriteria['sub_kriteria_id'] }}">{{ $subs_kriteria['deskripsi'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif

                                            @endif
                                            @endforeach
                                           
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                </form>
                             
                            </div>
                        </div>
                    </div>
                    @endforeach
         

                    @foreach ($kriteria as $value)
                    <!-- Modal -->
                    <div class="modal fade" id="edit{{ $value->kriteria_id }}{{ $keys->alternatif_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit Penilaian</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <form action="{{ url('Penilaian/edit') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        @foreach ($kriteria as $key)
                                            @php
                                            $modalId = $value->kriteria_id
                                            @endphp

                                            @if($modalId == $key->kriteria_id)

                                            @php
                                            $sub_kriteria = \App\Models\SubKriteriaModel::data_sub_kriteria($key->kriteria_id);
                                            @endphp
                                            @if ($sub_kriteria != NULL)
                                                <input type="hidden" name="alternatif_id" value="{{ $keys->alternatif_id }}">
                                                <input type="hidden" name="kriteria_id" value="{{ $key->kriteria_id }}">
                                                <div class="form-group">
                                                <label for="periode_id" class="font-weight-bold">Periode</label>
                                                <input autocomplete="off" readonly type="text" id="periode_id" class="form-control" name="periode_id" value="{{ $periode->periode_id }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="{{ $key->kriteria_id }}">{{ $key->keterangan }}</label>
                                                    <select name="nilai" class="form-control" id="{{ $key->kriteria_id }}" required>
                                                        <option value="">--Pilih--</option>
                                                        @foreach ($sub_kriteria as $subs_kriteria)
                                                            @php
                                                            $nilai = \App\Models\PenilaianModel::data_penilaian($keys->alternatif_id, $subs_kriteria['kriteria_id']);
                                                            @endphp
                                                            <option value="{{ $subs_kriteria['sub_kriteria_id'] }}" {{ isset($subs_kriteria['sub_kriteria_id']) && $nilai && $subs_kriteria['sub_kriteria_id'] == $nilai->nilai ? 'selected' : '' }}>{{ $subs_kriteria['deskripsi'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif

                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                        
                    <?php 
                        $no++;
                    ?>
				    @endforeach
			</tbody>
		</table>
	</div>
</div>

@include('layouts.footer_admin')


