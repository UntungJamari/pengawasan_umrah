<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Judul -->
    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 ">
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(auth()->user()->level == 'kanwil')
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    Kantor Wilayah Kementerian Agama Sumatra Barat
                </span>
                <img class="img-profile rounded-circle" src="/storage/{{ auth()->user()->kanwil->logo }}">
                @endif
                @if(auth()->user()->level == 'kab/kota')
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ auth()->user()->kemenag_kab_kota->nama }}
                </span>
                <img class="img-profile rounded-circle" src="/storage/{{ auth()->user()->kemenag_kab_kota->logo }}">
                @endif
                @if(auth()->user()->level == 'ppiu')
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ auth()->user()->ppiu->nama }}
                </span>
                <img class="img-profile rounded-circle" src="/storage/{{ auth()->user()->ppiu->logo }}">
                @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/profil">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="profil/gantipassword">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                    Ganti Password
                </a>
                <div class="dropdown-divider"></div>
                <form action="/logout" method="POST" onsubmit="return logout(this);">
                    <button class="dropdown-item" id="btn-logout">
                        @csrf
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->
<script>
    function logout(form) {
        Swal.fire({
            title: 'Apakah Anda Yakin Ingin Logout?',
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