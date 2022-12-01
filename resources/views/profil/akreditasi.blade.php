@extends('layout.main')

@section('container')

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Perbarui Akreditasi</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form class="row g-2" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6 form-group">
                        <label for="validationCustom02" class="form-label">Tanggal Akreditasi</label>
                        <input autofocus type="date" class="form-control @error('tanggal_akreditasi') is-invalid @enderror" id="validationCustom02" name="tanggal_akreditasi" value="{{ old('tanggal_akreditasi') }}" required>
                        @error('tanggal_akreditasi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="validationCustom03" class="form-label">Bukti</label><br>
                        <input type="file" class="@error('bukti') is-invalid @enderror" id="validationCustom03" name="bukti" required><br>
                        <p style="font-size: 12px; @error('bukti') color: red; @enderror">*ukuran file maksimal 2 mb dan format file : .pdf</p>
                    </div>
                    <div class="col-md-12 form-group">
                        <center>
                            <button type="submit" class="btn btn-outline-primary btn-sm my-3" name="simpan">
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
@endsection