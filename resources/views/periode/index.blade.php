@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-book"></i> Data Periode</h1>
    <div>
        <a href="{{ url('Periode/tambah') }}" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
    </div>
</div>

@if (session('message'))
{!! session('message') !!}
@endif

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Daftar Data Periode</h6>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <label>Daftar Periode</label>
                <!-- <select id="filter-periode" class="form-control">
                    <option value="">--Pilih Periode--</option>
                    @foreach ($list as $data)
                    <option> {{$data->periode_nama }}</option>
                    @endforeach
                </select> -->

                <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    Pilih Periode
                </button>
                <div class="dropdown-menu">
                    @foreach ($list as $data)
                        <form action="{{ url('Periode/aktifkan') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="periode_id" value="{{ $data->periode_id }}">
                            <button class="dropdown-item" type="submit">{{ $data->periode_nama }}</button>
                        </form>
                    @endforeach
                </div>
                </div>
            </div>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-info text-white">
                        <tr align="center">
                            <th width="5%">No</th>
                            <th>Periode</th>
                            <th>Nama Periode</th>
                            <th>Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($list as $data)
                        <tr align="center">
                            <td>{{ $no }}</td>
                            <td class="text-left">{{ $data->periode_id }}</td>
                            <td class="text-left">{{ $data->periode_nama }}</td>
                            <td class="text-left">{{ $data->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Edit Data"
                                        href="{{ url('Periode/edit/'.$data->periode_id) }}"
                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    <a data-toggle="tooltip" data-placement="bottom" title="Hapus Data"
                                        href="{{ url('Periode/destroy/'.$data->periode_id) }}"
                                        onclick="return confirm('Apakah anda yakin untuk menghapus data ini')"
                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @php
                        $no++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('layouts.footer_admin')