@extends('layout.main')

@section('container')
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
                <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                @if(auth()->user()->level == 'kanwil')
                <p>Menu Dashboard akan mengarahkan anda ke halaman yang menampilakan jumlah PPIU, jumlah pengisian blanko pengawasan umrah dan jumlah jemaah yang berangkat umrah di Provinsi Sumatra Barat</p>
                @endif
                @if(auth()->user()->level == 'kab/kota')
                <p>Menu Dashboard akan mengarahkan anda ke halaman yang menampilakan jumlah PPIU, jumlah pengisian blanko pengawasan umrah dan jumlah jemaah yang berangkat umrah di Kabupaten/Kota anda</p>
                @endif
                @if(auth()->user()->level == 'ppiu')
                <p>Menu Dashboard akan mengarahkan anda ke halaman yang menampilakan jumlah blanko pengawasan umrah yang telah diisi dan jumlah jemaah umrah yang telah diberangkatkan</p>
                @endif
            </div>
        </div>
        @if(auth()->user()->level != 'ppiu')
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">PPIU</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <strong class="text-primary">Daftar PPIU</strong>
                @if(auth()->user()->level == 'kanwil')
                <p>Menu PPIU akan mengarahkan anda ke halaman yang menampilakan tabel data PPIU yang ada di Sumatra Barat. Pada halaman ini terdapat fitur pencarian berdasarkan seluruh kolom dan pengurutan data PPIU berdasarkan kolom tertentu. Tanda "<i class="fas fa-fw fa fa-exclamation-triangle text-danger"></i>" pada kolom nomor menandakan bahwa PPIU tersebut hampir atau sudah habis akreditasinya.</p>
                @endif
                @if(auth()->user()->level == 'kab/kota')
                <p>Menu PPIU akan mengarahkan anda ke halaman yang menampilakan tabel data PPIU yang ada di Kabupaten/Kota anda. Pada halaman ini terdapat fitur pencarian berdasarkan seluruh kolom dan pengurutan data PPIU berdasarkan kolom tertentu. Tanda "<i class="fas fa-fw fa fa-exclamation-triangle text-danger"></i>" pada kolom nomor menandakan bahwa PPIU tersebut hampir atau sudah habis akreditasinya.</p>
                @endif
                <strong class="text-primary">Detail PPIU</strong>
                <p>Untuk melihat detail dari PPIU, dapat dilakukan dengan menekan tombol <a type="button" class="btn btn-outline-info btn-sm"><i class="fas fa-fw fa fa-eye"></i></a> pada data PPIU yang ingin dilihat detailnya kemudian akan tampil seluruh data yang berkaitan dengan PPIU tersebut. Pada fitur detail ini juga akan muncul peringatan jika PPIU tersebut hampir atau sudah habis akreditasinya.</p>
                <strong class="text-primary">Tambah PPIU</strong>
                <p>Untuk menambah data PPIU, dapat dilakukan dengan menekan tombol <a type="button" class="btn btn-outline-info btn-sm"><i class="fas fa-fw fa fa-plus"></i><span>Tambah PPIU</span></a> kemudian akan tampil form untuk pengisian data PPIU, dengan ketentuan sebagai berikut:
                <ul>
                    @if(auth()->user()->level == 'kanwil')
                    <li>Isilah isian status terlebih dahulu. Jika anda memilih pusat, maka anda tidak diberi bantuan untuk mengisi nama PPIU. Jika anda memilih cabang, maka anda akan diberi bantuan untuk mengisi nama PPIU, dimana nama yang akan tampil adalah nama PPIU pusat yang telah terdaftar kemudian isian logo PPIU akan hilang karena logonya akan sama dengan PPIU pusatnya.</li>
                    <li>Isian logo memiliki ketentuan file yang diupload harus berupa gambar dan ukurannya tidak melebihi 1 mb. Preview dari gambar yang dipilih akan ditampilkan</li>
                    <li>Isian yang boleh kosong hanyalah nama pimpinan dan logo.</li>
                    @endif
                    @if(auth()->user()->level == 'kab/kota')
                    <li>Anda hanya bisa menambahkan PPIU cabang.</li>
                    <li>Isilah isian nama PPIU, nantinya akan muncul bantuan berupa dropdown yang berisi nama-nama PPIU pusat yang telah terdaftar.</li>
                    <li>Isian yang boleh kosong hanyalah nama pimpinan.</li>
                    @endif
                    <li>Isian nama PPIU dan username memiliki ketentuan minimal 7 karakter.</li>
                    <li>Isian password akan diisikan secara default yaitu 12345678.</li>
                    <li>Pastikan seluruh isian sudah benar, jika sudah klik tombol "Simpan".</li>
                </ul>
                </p>
                <strong class="text-primary">Edit PPIU</strong>
                <p>Untuk mengubah data PPIU, dapat dilakukan dengan menekan tombol <a type="button" class="btn btn-outline-warning btn-sm"><i class="fas fa-fw fa fa-edit"></i></a> pada data PPIU yang ingin diubah kemudian akan tampil form untuk mengubah data PPIU, dengan ketentuan sebagai berikut:
                <ul>
                    <li>Untuk melakukan reset password PPIU dapat dilakukan dengan langsung menekan tombol kemudian akan muncul konfirmasi.</li>
                    @if(auth()->user()->level == 'kanwil')
                    <li>Jika anda memilih PPIU dengan status cabang, maka isian nama PPIU dan logo tidak akan muncul</li>
                    <li>Isian yang boleh kosong hanyalah nama pimpinan dan logo.</li>
                    <li>Isian logo memiliki ketentuan file yang diupload harus berupa gambar dan ukurannya tidak melebihi 1 mb. Preview dari gambar yang dipilih akan ditampilkan di sebelah kanan tombol "Pilih Gambar"</li>
                    <li>Isian nama PPIU dan username memiliki ketentuan minimal 7 karakter.</li>
                    @endif
                    @if(auth()->user()->level == 'kab/kota')
                    <li>Anda hanya bisa mengubah data PPIU cabang.</li>
                    <li>Isian username memiliki ketentuan minimal 7 karakter.</li>
                    <li>Isian yang boleh kosong hanyalah nama pimpinan.</li>
                    @endif
                    <li>Pastikan seluruh isian sudah benar, jika sudah klik tombol "Simpan".</li>
                </ul>
                </p>
                <strong class="text-primary">Hapus PPIU</strong>
                @if(auth()->user()->level == 'kanwil')
                <p>Untuk menghapus data PPIU, dapat dilakukan dengan menekan tombol <a type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-fw fa fa-trash-alt"></i></a> pada data PPIU yang ingin dihapus kemudian akan tampil konfirmasi untuk menghapusnya. Jika anda menghapus PPIU pusat, maka seluruh cabangnya juga akan dihapus.</p>
                @endif
                @if(auth()->user()->level == 'kab/kota')
                <p>Anda hanya bisa mengahapus PPIU cabang yang ada di Kabupaten/Kota anda saja. Untuk menghapus data PPIU, dapat dilakukan dengan menekan tombol <a type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-fw fa fa-trash-alt"></i></a> pada data PPIU yang ingin dihapus kemudian akan tampil konfirmasi untuk menghapusnya</p>
                @endif
            </div>
        </div>
        @endif
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Pengawasan</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <strong class="text-primary">Daftar Pengawasan</strong>
                @if(auth()->user()->level == 'kanwil')
                <p>Menu Pengawasan akan mengarahkan anda ke halaman yang menampilakan tabel data pengisian blanko pengawasan umrah yang diisi oleh seluruh PPIU yang ada di Sumatra Barat. Pada halaman ini terdapat fitur pencarian berdasarkan seluruh kolom dan pengurutan data isian blanko pengawasan umrah berdasarkan kolom tertentu.</p>
                @endif
                @if(auth()->user()->level == 'kab/kota')
                <p>Menu Pengawasan akan mengarahkan anda ke halaman yang menampilakan tabel data pengisian blanko pengawasan umrah yang diisi oleh seluruh PPIU yang ada di Kabupaten/Kota anda. Pada halaman ini terdapat fitur pencarian berdasarkan seluruh kolom dan pengurutan data isian blanko pengawasan umrah berdasarkan kolom tertentu.</p>
                @endif
                @if(auth()->user()->level == 'ppiu')
                <p>Menu Pengawasan akan mengarahkan anda ke halaman yang menampilakan tabel data isian blanko pengawasan umrah yang telah diisi. Pada halaman ini terdapat fitur pencarian berdasarkan seluruh kolom dan pengurutan data isian blanko pengawasan umrah berdasarkan kolom tertentu.</p>
                @endif
                <strong class="text-primary">Detail Pengawasan</strong>
                <p>Untuk melihat detail dari data isian blanko pengawasan umrah, dapat dilakukan dengan menekan tombol <a type="button" class="btn btn-outline-info btn-sm"><i class="fas fa-fw fa fa-eye"></i></a> pada data isian blanko pengawasan umrah yang ingin dilihat detailnya.</p>
                @if(auth()->user()->level == 'ppiu')
                <strong class="text-primary">Blanko Pengawasan Umrah</strong>
                <p>Untuk menambah data isian blanko pengawasan umrah, dapat dilakukan dengan menekan tombol <a type="button" class="btn btn-outline-info btn-sm"><i class="fas fa-fw fa fa-plus"></i><span>Blanko Pengawasan Umrah</span></a> kemudian akan tampil blanko pengawasan umrah, dengan ketentuan sebagai berikut:
                <ul>
                    <li>Tidak ada isian yang boleh kosong.</li>
                    <li>Data jemaah berupa file .pdf hasil scan dari data jemaah, dimana 1 orang jemaah memiliki 1 file sehingga jumlah jemaah harus sama dengan jumlah file yang di-upload.</li>
                    <li>Nama file harus sama dengan nama jemaah. (Misalkan nama jemaah : Muhammad Ibrahim, maka nama file : Muhammad Ibrahim.pdf)</li>
                </ul>
                </p>
                <strong class="text-primary">Edit Isian Blanko Pengawasan Umrah</strong>
                <p>Untuk mengubah data isian blanko pengawasan umrah, dapat dilakukan dengan menekan tombol <a type="button" class="btn btn-outline-warning btn-sm"><i class="fas fa-fw fa fa-edit"></i></a> pada data yang ingin diubah kemudian akan tampil form untuk mengubah data isian blanko pengawasan umrah, dengan ketentuan sebagai berikut:
                <ul>
                    <li>Jumlah jemaah dan file data jemaah tidak dapat diedit, sehingga jika terjadi kesalahan maka hapus saja data isian blanko pengawasan dengan menekan tombol <a type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-fw fa fa-trash-alt"></i></a> pada halaman daftar isian blanko pengawasan umrah kemudian isi blanko pengawasan umrah yang baru.</li>
                    <li>Tidak ada isian yang boleh kosong.</li>
                    <li>Pastikan seluruh isian sudah benar, jika sudah klik tombol "Simpan".</li>
                </ul>
                </p>
                <strong class="text-primary">Hapus Data Isian Blanko Pengawasan Umrah</strong>
                <p>Untuk menghapus data isian blanko pengawasan umrah, dapat dilakukan dengan menekan tombol <a type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-fw fa fa-trash-alt"></i></a> pada data yang ingin dihapus kemudian akan tampil konfirmasi untuk menghapusnya.</p>
                @endif
                <strong class="text-primary">Export Data Pengawasan</strong>
                <p>Untuk meng-export data pengawasan dapat dilakukan dengan mengklik tombol "Export ke Excel". Setelah itu pilih bulan dan tahun keberangktan yang ingin di-export. Jika tidak ada data pengawasan pada bulan dan tahun keberangkatan yang dipilih maka akan tampil pesan "Data Kosong!". Hasil Export berupa file excel.</p>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Profil</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <strong class="text-primary">Lihat Profil</strong>
                @if(auth()->user()->level != 'ppiu')
                <p>Untuk melihat profil, anda perlu menekan nama pengguna atau logo dari pengguna yang sedang login. Setelah itu akan muncul menu dropdown kemudian klik menu "Profil".</p>
                @endif
                @if(auth()->user()->level == 'ppiu')
                <p>Untuk melihat profil, anda perlu menekan nama pengguna atau logo dari pengguna yang sedang login. Setelah itu akan muncul menu dropdown kemudian klik menu "Profil". Pada halaman profil ini juga akan tampil peringatan jika akreditasi anda akan atau sudah habis.</p>
                @endif
                <strong class="text-primary">Edit Profil</strong>
                <p>Setelah berada di halaman lihat profil, jika anda ingin mengubah data-data pada profil silahkan klik tombol <a type="button" class="btn btn-outline-warning btn-sm"><i class="fas fa-fw fa fa-edit"></i><span>Edit Profil</span></a>. Berikut ketentuan edit profil:
                <ul>
                    @if(auth()->user()->level != 'ppiu')
                    <li>Data yang dapat diedit hanyalah username, nama pimpinan dan alamat.</li>
                    <li>Seluruh isian tidak boleh ada yang kosong.</li>
                    <li>isian username minimal 7 karakter.</li>
                    <li>Pastikan seluruh isian sudah benar, jika sudah klik tombol "Simpan".</li>
                    @endif
                    @if(auth()->user()->level == 'ppiu')
                    <li>Hanya PPIU pusat yang dapat mengubah nama dan logo.</li>
                    <li>Isian yang boleh kosong hanyalah logo.</li>
                    <li>isian username minimal 7 karakter.</li>
                    <li>Pastikan seluruh isian sudah benar, jika sudah klik tombol "Simpan".</li>
                    @endif
                </ul>
                </p>
                @if(auth()->user()->level == 'ppiu')
                <strong class="text-primary">Perbarui Data Akreditasi</strong>
                <p>Setelah berada di halaman lihat profil, jika anda ingin memperbarui data akreditasi, silahkan klik tombol <a type="button" class="btn btn-outline-info btn-sm"><i class="fas fa-fw fa fa-redo-alt"></i><span>Perbarui Data Akreditasi</span></a>. Berikut ketentuan memperbarui data akreditasi:
                <ul>
                    <li>Tanggal akreditasi diisi dengan tanggal mulai berlakunya akreditasi pada sertifikat atau dokumen akreditasi.</li>
                    <li>Sertifikat atau dokumen akreditasi harus diisikan pada input "Bukti".</li>
                    <li>Pastikan seluruh isian sudah benar, jika sudah klik tombol "Simpan".</li>
                </ul>
                </p>
                @endif
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Ganti Password</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Untuk mengganti password, anda perlu menekan nama pengguna atau logo dari pengguna yang sedang login. Setelah itu akan muncul menu dropdown kemudian klik menu "Ganti Password" kemudian akan muncul form ganti password. Silakan masukkan password lama dan password baru anda.</p>
            </div>
        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Logout</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Untuk logout, anda perlu menekan nama pengguna atau logo dari pengguna yang sedang login. Setelah itu akan muncul menu dropdown kemudian klik menu "Logout" kemudian akan muncul konfirmasi. Setelah itu anda akan diarahkan kembali ke halaman login.</p>
            </div>
        </div>
    </div>
</div>
@endsection