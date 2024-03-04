@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Periode</h1>

    <a href="{{ url('Periode') }}" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

@if (session('message'))
    {!! session('message') !!}
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-fw fa-plus"></i> Tambah Data Periode</h6>
    </div>

    <form action="{{ url('Periode/simpan') }}" method="POST">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Periode</label>
                    <input autocomplete="off" type="text" name="periode_id" required class="form-control"/>
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Nama Periode</label>
                    <input autocomplete="off" type="text" name="periode_nama" required class="form-control"/>
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Status</label>
                    <div class="icheck-success mr-2">
                        <input type="radio" id="radioAktif" name="is_active" value="1">
                        <label for="radioAktif">Aktif </label>
                    </div>
                    <div class="icheck-warning">
                        <input type="radio" id="radioNonAktif" name="is_active" value="0">
                        <label for="radioNonAktif">Non-aktif</label>
                    </div>
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
