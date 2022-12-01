<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(#076b07, #5cf25c);">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon">
            <img src="{{ URL::asset('images/logo_kemenag.png') }}" alt="logo_kemenag" style="width: 50px;">
        </div>
        <div class="sidebar-brand-text mx-3">Pengawasan Umrah</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    @if(auth()->user()->level != 'ppiu')
    <li class="nav-item {{ Request::is('ppiu*') ? 'active' : '' }}">
        <a class="nav-link" href="/ppiu">
            <i class="fas fa-fw fa-building"></i>
            <span>PPIU</span></a>
    </li>
    @endif

    <li class="nav-item {{ Request::is('pengawasan*') ? 'active' : '' }}">
        <a class="nav-link" href="/pengawasan">
            <i class="fas fa-fw fa fa-file-alt"></i>
            <span>Pengawasan</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->