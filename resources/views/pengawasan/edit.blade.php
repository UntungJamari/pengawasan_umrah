@extends('layout.main')

@section('container')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ $subtitle }}</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <a href="/pengawasan" type="button" class="btn btn-outline-warning btn-sm mb-3">
                    <i class="fas fa-fw fa fa-arrow-alt-circle-left"></i>
                    <span>Kembali</span>
                </a>
                <form class="row g-2 mt-3" action="/pengawasan/update/{{ $pengawasan->id }}" method="POST" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Izin</label><label style="color: red;">*</label>
                        <input autofocus type="text" class="form-control @error('izin') is-invalid @enderror" id="input1" name="izin" value="{{ old('izin', $pengawasan->izin) }}">
                        @error('izin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Tanggal Keberangkatan</label><label style="color: red;">*</label>
                        <input autofocus type="date" class="form-control @error('tanggal_keberangkatan') is-invalid @enderror" id="input1" name="tanggal_keberangkatan" value="{{ old('tanggal_keberangkatan', $pengawasan->tanggal_keberangkatan) }}">
                        @error('tanggal_keberangkatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Tanggal Kepulangan</label><label style="color: red;">*</label>
                        <input autofocus type="date" class="form-control @error('tanggal_kepulangan') is-invalid @enderror" id="input1" name="tanggal_kepulangan" value="{{ old('tanggal_kepulangan', $pengawasan->tanggal_kepulangan) }}">
                        @error('tanggal_kepulangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="validationCustom04" class="form-label">Temuan Lapangan</label><label style="color: red;">*</label>
                        <textarea class="form-control @error('temuan_lapangan') is-invalid @enderror" name="temuan_lapangan" id="validationCustom04" cols="30" rows="3">{{ old('temuan_lapangan', $pengawasan->temuan_lapangan) }}</textarea>
                        @error('temuan_lapangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Petugas 1</label><label style="color: red;">*</label>
                        <input autofocus type="text" class="form-control @error('petugas_1') is-invalid @enderror" id="input1" name="petugas_1" value="{{ old('petugas_1', $pengawasan->petugas_1) }}">
                        @error('petugas_1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Petugas 2</label><label style="color: red;">*</label>
                        <input autofocus type="text" class="form-control @error('petugas_2') is-invalid @enderror" id="input1" name="petugas_2" value="{{ old('petugas_2', $pengawasan->petugas_2) }}">
                        @error('petugas_2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <center>
                            <button type="submit" class="btn btn-outline-primary btn-sm mt-5 mb-3" name="simpan" id="simpan">
                                <i class="fas fa-fw fa fa-save"></i>
                                <span>Simpan</span>
                            </button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(session()->has('berhasil'))
<script>
    swal.fire({
        icon: 'success',
        showConfirmButton: false,
        timer: '2000',
        title: '{{ session("berhasil") }}'
    })
</script>
@endif
@endsection