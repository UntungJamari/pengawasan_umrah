@extends('layout.main')

@section('container')
<!-- Custom styles for this page -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('datatables/dataTables.bootstrap5.min.css') }}">

<!-- Page level plugins -->
<script src="{{ URL::asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('datatables/dataTables.bootstrap5.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ URL::asset('js/demo/datatables-demo.js') }}"></script>
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
                <h6 class="m-0 font-weight-bold text-primary">Daftar PPIU</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <a href="ppiu/create" type="button" class="btn btn-outline-info btn-sm mb-3">
                    <i class="fas fa-fw fa fa-plus"></i>
                    <span>Tambah PPIU</span>
                </a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:20px">No.</th>
                                <th>Nama PPIU</th>
                                <th>Status</th>
                                @if(auth()->user()->level === 'kanwil')
                                <th>Kabupaten/Kota</th>
                                @endif
                                <th>Alamat</th>
                                <th style="width: 14%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ppius as $ppiu)
                            <tr>
                                <td>{{ $loop->iteration }} <i class="@if($ppiu->id_akreditasi == null) fas fa-fw fa fa-exclamation-triangle text-danger @endif @if($ppiu->id_akreditasi != null) {{ (strtotime(date('d-m-Y')) >= strtotime(date('d-m-Y', strtotime($ppiu->akreditasi->tanggal_akreditasi . ' +4 year')))) ? 'fas fa-fw fa fa-exclamation-triangle text-danger' : '' }} @endif"></i></td>
                                <td>{{ $ppiu->nama }}</td>
                                <td>{{ $ppiu->status }}</td>
                                @if(auth()->user()->level === 'kanwil')
                                <td>{{ $ppiu->kab_kota->nama }}</td>
                                @endif
                                <td>{{ $ppiu->alamat }}</td>
                                <td>
                                    <a id="detail" type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal-detail" data-nama_ppiu="{{ $ppiu->nama }}" data-username="{{ $ppiu->user->username }}" data-nama_kab_kota="{{ $ppiu->kab_kota->nama }}" data-status="{{ $ppiu->status }}" data-nomor_sk="{{ $ppiu->nomor_sk }}" data-tanggal_sk="{{ date('d-m-Y', strtotime($ppiu->tanggal_sk)) }}" data-alamat="{{ $ppiu->alamat }}" data-nama_pimpinan="{{ $ppiu->nama_pimpinan }}" data-logo="{{ $ppiu->logo }}" data-tanggal_akreditasi="@if($ppiu->id_akreditasi == null) @endif @if($ppiu->id_akreditasi != null){{ date('d-m-Y', strtotime($ppiu->akreditasi->tanggal_akreditasi)) }} @endif" data-pesan_akreditasi="@if($ppiu->id_akreditasi == null)Belum Melakulan Akreditasi!@endif @if($ppiu->id_akreditasi != null) @if((strtotime(date('d-m-Y')) >= strtotime(date('d-m-Y', strtotime($ppiu->akreditasi->tanggal_akreditasi . ' +4 year')))) && (strtotime(date('d-m-Y')) <= strtotime(date('d-m-Y', strtotime($ppiu->akreditasi->tanggal_akreditasi . ' +5 year'))))) Akreditasi Akan Habis! @endif @if(strtotime(date('d-m-Y')) > strtotime(date('d-m-Y', strtotime($ppiu->akreditasi->tanggal_akreditasi . ' +5 year')))) Akreditasi Sudah Habis! @endif @endif" data-bukti_akreditasi="@if($ppiu->id_akreditasi == null) @endif @if($ppiu->id_akreditasi != null){{ $ppiu->akreditasi->bukti }}@endif">
                                        <i class="fas fa-fw fa fa-eye"></i>
                                    </a>
                                    @if(auth()->user()->level === 'kanwil' || $ppiu->status == 'Cabang')
                                    <a href="/ppiu/update/{{ $ppiu->id }}" type="button" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-fw fa fa-edit"></i>
                                    </a>
                                    <form action="/ppiu/delete/{{ $ppiu->id }}" method="POST" class="d-inline" onsubmit="return submitForm(this);">
                                        @csrf
                                        <button id="hapus-ppiu" type="submit" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-hapus" data-username="{{ $ppiu->id_user }}">
                                            <i class="fas fa-fw fa fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content card shadow mb-4">
            <div class="modal-header card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h4 class="modal-title m-0 font-weight-bold text-primary">Detail PPIU</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive card-body">
                <div class="content-alert" id="content-alert">

                </div>
                <center>
                    <img class="mb-5" id="gambar" style="width: 300px;">
                </center>
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th>Nama PPIU</th>
                            <td><span id="nama_ppiu"></span></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><span id="username"></span></td>
                        </tr>
                        <tr>
                            <th>Kab/Kota</th>
                            <td><span id="nama_kab_kota"></span></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span id="status"></span></td>
                        </tr>
                        <tr>
                            <th>Nama Pimpinan</th>
                            <td><span id="nama_pimpinan"></span></td>
                        </tr>
                        <tr>
                            <th>Nomor SK</th>
                            <td><span id="nomor_sk"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal SK</th>
                            <td><span id="tanggal_sk"></span></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><span id="alamat"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal Akreditasi</th>
                            <td><span id="tanggal_akreditasi"></span><br><a href="" id="bukti_akreditasi" target="_blank"></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '#detail', function() {
            var nama_ppiu = $(this).data('nama_ppiu');
            var username = $(this).data('username');
            var nama_kab_kota = $(this).data('nama_kab_kota');
            var status = $(this).data('status');
            var nomor_sk = $(this).data('nomor_sk');
            var tanggal_sk = $(this).data('tanggal_sk');
            var alamat = $(this).data('alamat');
            var nama_pimpinan = $(this).data('nama_pimpinan');
            var logo = $(this).data('logo');
            var tanggal_akreditasi = $(this).data('tanggal_akreditasi');
            var pesan_akreditasi = $(this).data('pesan_akreditasi');
            var bukti_akreditasi = $(this).data('bukti_akreditasi');
            $('#nama_ppiu').text(nama_ppiu);
            $('#username').text(username);
            $('#nama_kab_kota').text(nama_kab_kota);
            $('#status').text(status);
            $('#nomor_sk').text(nomor_sk);
            $('#tanggal_sk').text(tanggal_sk);
            $('#alamat').text(alamat);
            $('#nama_pimpinan').text(nama_pimpinan);
            $('#logo').text(logo);
            $('#gambar').attr('src', 'storage/' + logo);
            $('#tanggal_akreditasi').text(tanggal_akreditasi);

            if (bukti_akreditasi !== '  ') {
                $('#bukti_akreditasi').text('Bukti Akreditasi');
                $('#bukti_akreditasi').attr('href', 'storage/' + bukti_akreditasi.split(' ').join(''));
            } else {
                $('#bukti_akreditasi').text('');
                $('#bukti_akreditasi').attr('href', '');
            }


            if (pesan_akreditasi !== '    ') {

                var content = document.querySelector('.content-alert');
                content.removeChild(content.lastChild);

                const elementBaru = document.createElement('div');

                elementBaru.innerText = pesan_akreditasi;

                elementBaru.className = "alert alert-danger alert-dismissible fade show";

                var content = document.querySelector('.content-alert');
                content.appendChild(elementBaru);
            } else {

                var content = document.querySelector('.content-alert');
                content.removeChild(content.lastChild);

                const elementBaru = document.createElement('div');

                elementBaru.innerText = "";

                elementBaru.className = "";

                var content = document.querySelector('.content-alert');
                content.appendChild(elementBaru);

            }

        })
    })
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<script>
    function submitForm(form) {
        Swal.fire({
            title: 'Apakah Anda Yakin Ingin Menghapus PPIU Ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#26c0fc',
            cancelButtonColor: '#f51d50',
            cancelButtonText: 'Tidak!',
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
        return false;
    }
</script>
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