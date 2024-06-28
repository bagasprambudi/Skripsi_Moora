@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Alternatif</h1>
    <div>
        <a href="{{ asset('template/template_alternatif.xlsx') }}" class="btn btn-primary"> <i class="fa fa-print"></i> Download Template Alternatif </a>

        <a  data-toggle="modal" href="#upload" class="btn btn-primary"> <i class="fa fa-upload"></i> Import Excel </a>

        <a href="{{ url('Alternatif/tambah') }}" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"><i class="fa fa-upload"></i> Pilih FIle Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form action="{{ url('Alternatif/upload') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" name="file" class="form-control" required/> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if (session('message'))
    {!! session('message') !!}
@endif

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Daftar Data Alternatif</h6>
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
                            <td class="text-left">{{ $data->alternatif_nama }}</td>
                            <td>{{ $data->alternatif_nik }}</td>
                            <td class="text-left">{{ $data->alternatif_alamat }}</td>
                            <td>{{ $data->RT }}</td>
                            <td>{{ $data->RW }}</td>                     
                            <td>
                                <div class="btn-group" role="group">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="{{ url('Alternatif/edit/'.$data->alternatif_id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    <a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="{{ url('Alternatif/destroy/'.$data->alternatif_id) }}" onclick="return confirm('Apakah anda yakin untuk menghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
