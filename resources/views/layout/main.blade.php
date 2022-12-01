<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="{{ URL::asset('images/logo_kemenag.png') }}">
    <title>{{ $title }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ URL::asset('font/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('font/font.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ URL::asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="{{ URL::asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ URL::asset('jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="{{ URL::asset('sweetalert2/sweetalert2.min.css') }}">
    <script src="{{ URL::asset('sweetalert2/sweetalert2.min.js') }}"></script>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('partial.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                @include('partial.header')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('container')
                </div>
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Kanwil Kemenag Sumbar 2022</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    </div>

    <!-- Custom scripts for all pages -->
    <script src="{{ URL::asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>