@extends('layout.main')

@section('container')
<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit Profil</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <a href="/profil" type="button" class="btn btn-outline-warning btn-sm mb-3">
                    <i class="fas fa-fw fa fa-arrow-alt-circle-left"></i>
                    <span>Kembali</span>
                </a>
                @if (auth()->user()->level == 'kanwil')
                <center>
                    <img src="{{ URL::asset('storage/'.$user->kanwil->logo) }}" style="width: 250px;" class="mb-5">
                    <h4 class="mb-3">Kanwil Kementerian Agama Sumatera Barat</h4>
                </center>
                <form class="row g-2" action="update" method="POST">
                    @csrf
                    <div class="col-md-6 form-group">
                        <label for="validationCustom02" class="form-label">Username</label>
                        <input autofocus type="text" class="form-control @error('username') is-invalid @enderror" id="validationCustom02" name="username" value="{{ old('username', $user->username) }}" required>
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="validationCustom03" class="form-label">Nama Pimpinan</label>
                        <input autofocus type="text" class="form-control @error('nama_pimpinan') is-invalid @enderror" id="validationCustom03" name="nama_pimpinan" value="{{ old('nama_pimpinan', $user->kanwil->nama_pimpinan) }}" required>
                        @error('nama_pimpinan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="validationCustom04" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="validationCustom04" cols="30" rows="3" required>{{ old('alamat', $user->kanwil->alamat) }}</textarea>
                        @error('alamat')
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
                @endif
                @if (auth()->user()->level == 'kab/kota')
                <center>
                    <img src="{{ URL::asset('storage/'.$user->kemenag_kab_kota->logo) }}" style="width: 250px;" class="mb-5">
                    <h4 class="mb-3">{{ $user->kemenag_kab_kota->nama }}</h4>
                </center>
                <form class="row g-2" action="update" method="POST">
                    @csrf
                    <div class="col-md-6 form-group">
                        <label for="validationCustom02" class="form-label">Username</label>
                        <input autofocus type="text" class="form-control @error('username') is-invalid @enderror" id="validationCustom02" name="username" value="{{ old('username', $user->username) }}" required>
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="validationCustom03" class="form-label">Nama Pimpinan</label>
                        <input autofocus type="text" class="form-control @error('nama_pimpinan') is-invalid @enderror" id="validationCustom03" name="nama_pimpinan" value="{{ old('nama_pimpinan', $user->kemenag_kab_kota->nama_pimpinan) }}" required>
                        @error('nama_pimpinan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="validationCustom04" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="validationCustom04" cols="30" rows="3" required>{{ old('alamat', $user->kemenag_kab_kota->alamat) }}</textarea>
                        @error('alamat')
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
                @endif
                @if (auth()->user()->level == 'ppiu')
                <form class="row g-2 mt-3" action="update" method="POST" id="form" enctype="multipart/form-data">
                    <div class="col-md-12 form-group">
                        <center>
                            <h4 class="mb-3">{{ $user->ppiu->nama }}<br>{{ $user->ppiu->status }}<br>{{ $user->ppiu->kab_kota->nama }}</h4>
                        </center>
                    </div>
                    @csrf
                    @if( $user->ppiu->status == 'Pusat' )
                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Nama PPIU</label><label style="color: red;">*</label>
                        <input autofocus type="text" class="form-control @error('nama') is-invalid @enderror" id="input1" name="nama" value="{{ old('nama', $user->ppiu->nama) }}" required>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif
                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Username</label>
                        <input autofocus type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="input1" value="{{ old('username', $user->username) }}" required>
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Nama Pimpinan</label>
                        <input autofocus type="text" class="form-control @error('nama_pimpinan') is-invalid @enderror" id="input1" name="nama_pimpinan" value="{{ old('nama_pimpinan', $user->ppiu->nama_pimpinan) }}">
                        @error('nama_pimpian')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Nomor SK</label><label style="color: red;">*</label>
                        <input autofocus type="text" class="form-control @error('nomor_sk') is-invalid @enderror" id="input1" name="nomor_sk" value="{{ old('nomor_sk', $user->ppiu->nomor_sk) }}" required>
                        @error('nomor_sk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Tanggal SK</label><label style="color: red;">*</label>
                        <input autofocus type="date" class="form-control @error('tanggal_sk') is-invalid @enderror" id="input1" name="tanggal_sk" value="{{ old('tanggal_sk', $user->ppiu->tanggal_sk) }}" required>
                        @error('tanggal_sk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="validationCustom04" class="form-label">Alamat</label><label style="color: red;">*</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="validationCustom04" cols="30" rows="3" required>{{ old('alamat', $user->ppiu->alamat) }}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @if( $user->ppiu->status == 'Pusat' )
                    <div class="col-md-5 form-group">
                        <label for="input1" class="form-label">Logo</label><br>
                        <input type="hidden" name="logo_lama" value="">
                        <img class="img-preview img-fluid col-12" src="{{ URL::asset('storage/'.$user->ppiu->logo) }}">
                    </div>
                    <div class="col-md-2 form-group">
                        <br>
                        <input type="file" id="file" name="logo" style="display: none;" class="form-control @error('logo') is-invalid @enderror">
                        <label for="file" class="btn btn-primary btn-user btn-block">
                            <i class="fas fa-fw fa fa-images">
                            </i>
                            Pilih Gambar
                        </label>
                    </div>
                    <div class="col-md-5 form-group">
                        <label for="input1" class="form-label">Logo Baru</label><br>
                        <img id="upload-img" class="img-preview img-fluid col-12">
                        <p style="font-size: 12px; @error('logo') color: red; @enderror">*ukuran file maksimal 1 mb dan format file : .jpg, .jpeg, .png</p>
                    </div>
                    @endif
                    <div class="col-md-12 form-group">
                        <center>
                            <button type="submit" class="btn btn-outline-primary btn-sm mt-5 mb-3" name="simpan" id="simpan">
                                <i class="fas fa-fw fa fa-save"></i>
                                <span>Simpan</span>
                            </button>
                        </center>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#file").change(function(event) {
            var x = URL.createObjectURL(event.target.files[0]);
            $("#upload-img").attr("src", x);
            console.log(event);
        });
    })
</script>
@endsection