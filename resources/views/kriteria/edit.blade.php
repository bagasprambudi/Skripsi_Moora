@php
$periode = session()->get('periode');
@endphp

@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Kriteria</h1>

    <a href="{{ url('Kriteria') }}" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-fw fa-edit"></i> Edit Data Kriteria</h6>
    </div>

    <form method="POST" action="{{ url('Kriteria/update/'.$kriteria->kriteria_id) }}">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="row">
                <input type="hidden" name="kriteria_id" value="{{ $kriteria->kriteria_id }}">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Periode</label>
                    <input autocomplete="off" readonly type="text" value="{{ $periode->periode_id }}" required class="form-control"/>
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Kode Kriteria</label>
                    <input autocomplete="off" type="text" name="kriteria_kode" value="{{ $kriteria->kriteria_kode }}" required class="form-control"/>
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Nama Kriteria</label>
                    <input autocomplete="off" type="text" name="keterangan" value="{{ $kriteria->keterangan }}" required class="form-control"/>
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Bobot Kriteria</label>
                    <input autocomplete="off" type="number" name="bobot" step="0.01" value="{{ $kriteria->bobot }}" required class="form-control"/>
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Jenis Kriteria</label>
                    <select name="jenis" class="form-control" required>
                        <option value="Benefit" {{ $kriteria->jenis == "Benefit" ? 'selected' : '' }}>Benefit</option>
                        <option value="Cost" {{ $kriteria->jenis == "Cost" ? 'selected' : '' }}>Cost</option>
                    </select>
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
