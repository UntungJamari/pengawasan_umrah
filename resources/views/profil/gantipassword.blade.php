@extends('layout.main')

@section('container')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Ganti Password</h6>
            </div>
            <div class="card-body">
                <form class="row g-2" action="/profil/gantipassword" method="POST">
                    @csrf
                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Password Lama</label>
                        <input autofocus type="password" class="form-control @error('password_lama') is-invalid @enderror" id="input1" name="password_lama" required>
                        @error('password_lama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="input2" class="form-label">Password Baru</label>
                        <input autofocus type="password" class="form-control @error('password_baru') is-invalid @enderror" id="input2" name="password_baru" required>
                        @error('password_baru')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="input3" class="form-label">Konfirmasi Password Baru</label>
                        <input autofocus type="password" class="form-control @error('konfirmasi_password_baru') is-invalid @enderror" id="input3" name="konfirmasi_password_baru" required>
                        @error('konfirmasi_password_baru')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
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
@if(session()->has('gagal'))
<script>
    swal.fire({
        icon: 'error',
        showConfirmButton: false,
        timer: '2000',
        title: '{{ session("gagal") }}'
    })
</script>
@endif
@endsection