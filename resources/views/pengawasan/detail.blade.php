@extends('layout.main')

@section('container')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pengawasan Umrah</h1>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ $subtitle }}</h6>
            </div>
            <div class="table-responsive card-body">
                <a href="/pengawasan" type="button" class="btn btn-outline-warning btn-sm mb-3">
                    <i class="fas fa-fw fa fa-arrow-alt-circle-left"></i>
                    <span>Kembali</span>
                </a>
                <center>
                    <table class="table table-bordered no-margin col-10">
                        <tbody>
                            <tr>
                                <th style="width: 300px;">Nama PPIU</th>
                                <td><span>{{ $pengawasan->ppiu->nama }}</span></td>
                            </tr>
                            <tr>
                                <th>Kab/Kota</th>
                                <td><span>{{ $pengawasan->ppiu->kab_kota->nama }}</span></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><span>{{ $pengawasan->ppiu->status }}</span></td>
                            </tr>
                            <tr>
                                <th>Hari</th>
                                <td><span>{{ $pengawasan->hari }}</span></td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td><span>{{ date('d-m-Y', strtotime($pengawasan->tanggal)) }}</span></td>
                            </tr>
                            <tr>
                                <th>Jam</th>
                                <td><span>{{ $pengawasan->jam }}</span></td>
                            </tr>
                            <tr>
                                <th>Izin</th>
                                <td><span>{{ $pengawasan->izin }}</span></td>
                            </tr>
                            <tr>
                                <th>
                                    Jumlah Jemaah<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;Laki-Laki<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;Wanita</th>
                                <td><br><span>{{ $pengawasan->jumlah_jemaah_laki_laki }}</span><br><span>{{ $pengawasan->jumlah_jemaah_wanita }}</span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Keberangkatan</th>
                                <td><span>{{ date('d-m-Y', strtotime($pengawasan->tanggal_keberangkatan)) }}</span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Kepulangan</th>
                                <td><span>{{ date('d-m-Y', strtotime($pengawasan->tanggal_kepulangan)) }}</span></td>
                            </tr>
                            <tr>
                                <th>Temuan Lapangan</th>
                                <td><span>{{ $pengawasan->temuan_lapangan }}</span></td>
                            </tr>
                            <tr>
                                <th>Petugas</th>
                                <td>
                                    <ol style="padding-left: 20px;">
                                        <li>{{ $pengawasan->petugas_1 }}</li>
                                        <li>{{ $pengawasan->petugas_2 }}</li>
                                    </ol>
                                </td>
                            </tr>
                            <tr>
                                <th>Data Jemaah</th>
                                <td>
                                    <ol style="padding-left: 20px;">
                                        @foreach($file_pengawasans as $file_pengawasan)
                                        <li><a href="/storage/{{ $file_pengawasan->file_jemaah }}" target="_blank">{{ $file_pengawasan->nama_jemaah }}</a></li>
                                        @endforeach
                                    </ol>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </center>
            </div>
        </div>
    </div>
</div>

@endsection