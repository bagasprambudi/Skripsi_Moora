@php
$periode = session()->get('periode');
@endphp

@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Alternatif</h1>

    <a href="{{ url('Alternatif') }}" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-fw fa-edit"></i> Edit Data Alternatif</h6>
    </div>

    <form method="POST" action="{{ url('Alternatif/update/'.$alternatif->alternatif_id) }}">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="row">
                <input type="hidden" name="alternatif_id" value="{{ $alternatif->alternatif_id }}">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Periode</label>
                    <input autocomplete="off" readonly type="text" name="periode_id" value="{{ $periode->periode_id }}" required class="form-control"/>
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Nama Alternatif</label>
                    <input autocomplete="off" type="text" name="alternatif_nama" value="{{ $alternatif->alternatif_nama }}" required class="form-control"/>
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Alamat</label>
                    <input autocomplete="off" type="text" name="alternatif_alamat" value="{{ $alternatif->alternatif_alamat }}" required class="form-control"/>
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold">RT</label>
                    <input autocomplete="off" type="text" name="rt" value="{{ $alternatif->RT }}" required class="form-control"/>
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold">RW</label>
                    <input autocomplete="off" type="text" name="rw" value="{{ $alternatif->RW }}" required class="form-control"/>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
        </div>
    </form>

</div>

@include('layouts.footer_admin')
