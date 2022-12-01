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
                <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            </div>
            <div class="table-responsive card-body">
                <center>
                    @if(auth()->user()->level == 'kanwil')
                    <img src="storage/{{ $user->kanwil->logo }}" style="width: 250px;" class="mb-5">
                    <h4 class="mb-3">{{ $nama }}</h4>
                    <table class="table table-bordered no-margin col-8">
                        <tbody>
                            <tr>
                                <th>Username</th>
                                <td><span>{{ $user->username }}</span></td>
                            </tr>
                            <tr>
                                <th>Nama Pimpinan</th>
                                <td><span>{{ $user->kanwil->nama_pimpinan }}</span></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><span>{{ $user->kanwil->alamat }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                    @if(auth()->user()->level == 'kab/kota')
                    <img src="storage/{{ $user->kemenag_kab_kota->logo }}" style="width: 250px;" class="mb-5">
                    <h4 class="mb-3">{{ $nama }}</h4>
                    <table class="table table-bordered no-margin col-8">
                        <tbody>
                            <tr>
                                <th>Username</th>
                                <td><span>{{ $user->username }}</span></td>
                            </tr>
                            <tr>
                                <th>Nama Pimpinan</th>
                                <td><span>{{ $user->kemenag_kab_kota->nama_pimpinan }}</span></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><span>{{ $user->kemenag_kab_kota->alamat }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                    @if(auth()->user()->level == 'ppiu')
                    @if($akreditasi !== '')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ $akreditasi }}</strong>
                    </div>
                    @endif
                    <img src="storage/{{ $user->ppiu->logo }}" style="width: 250px;" class="mb-5">
                    <h4 class="mb-3">{{ $nama }}</h4>
                    <table class="table table-bordered no-margin col-8">
                        <tbody>
                            <tr>
                                <th style="width: 150px;">Username</th>
                                <td><span>{{ $user->username }}</span></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><span>{{ $user->ppiu->status }}</span></td>
                            </tr>
                            <tr>
                                <th>Nama Pimpinan</th>
                                <td><span>{{ $user->ppiu->nama_pimpinan }}</span></td>
                            </tr>
                            <tr>
                                <th>Nomor SK</th>
                                <td><span>{{ $user->ppiu->nomor_sk }}</span></td>
                            </tr>
                            <tr>
                                <th>Tanggal SK</th>
                                <td><span>{{ date('d-m-Y', strtotime($user->ppiu->tanggal_sk)) }}</span></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><span>{{ $user->ppiu->alamat }}</span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Akreditasi</th>
                                <td>
                                    <div class="row col-md-12">
                                        <div class="col-md-6">
                                            @if($user->ppiu->id_akreditasi === null)
                                            <span>-</span>
                                            @endif
                                            @if($user->ppiu->id_akreditasi !== null)
                                            <span>{{ date('d-m-Y', strtotime($user->ppiu->akreditasi->tanggal_akreditasi)) }}</span><br><a href="storage/{{ $user->ppiu->akreditasi->bukti }}" target="_blank">Bukti Akreditasi</a>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <a href="/profil/akreditasi" type="button" class="btn btn-outline-info btn-sm mb-3">
                                                <i class="fas fa-fw fa fa-redo-alt"></i>
                                                <span>Perbarui Data Akreditasi</span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                    <a href="profil/update" type="button" class="btn btn-outline-warning btn-sm my-3">
                        <i class="fas fa-fw fa fa-edit"></i>
                        <span>Edit Profil</span>
                    </a>
                </center>
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