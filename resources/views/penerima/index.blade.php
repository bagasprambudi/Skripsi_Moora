@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Penerima</h1>
	
    <a href="{{ url('Laporan') }}" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Data </a>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Data Penerima</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-info text-white">
                    <?php $no = 1; ?>

                    <tr align="center">
                        <th width="6%">No</th>
                        <th>Nama Penerima</th>
                        <th>Alamat</th>
                        <th>RW</th>
                        <th>RT</th>
                        <th width="15%">Ranking</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($hasil as $keys)
                    <tr align="center">
                        <td>{{ $no }}</td>
                        <td align="left">{{ $keys->alternatif_nama }}</td>
                        <td class="text-left">{{ $keys->alternatif_alamat }}</td>
                        <td>{{ $keys->RT }}</td>
                        <td>{{ $keys->RW }}</td>
                        <td>{{ $no }}</td>
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
