<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="images/logo_kemenag.png">
    <title>{{ $title }}</title>

    <!-- Custom fonts for this template-->
    <link href="font/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="font/font.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="sweetalert2/sweetalert2.min.css">
    <script src="sweetalert2/sweetalert2.min.js"></script>

</head>

<body class="background">
    <style type="text/css">
        .background {
            background: linear-gradient(#076b07, #5cf25c);
        }
    </style>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-4 col-md-5">
                <div class="card o-hidden border-0 shadow-lg mt-5">
                    <div class="card-body p-1">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="p-5">
                                <form class="user" method="post" action="/login">
                                    @csrf
                                    <div class="text-center">
                                        <img src="images/logo_kemenag.png" alt="logo_kemenag.png" width="30%">
                                    </div>
                                    <div class="text-center mt-5">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang di Sistem Informasi Pengawasan Umrah Sumatera Barat</h1>
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
                                    </div>
                                    <div class="form-group mt-5">
                                        <input type="username" name="username" class="form-control form-control-user @error('username') is-invalid @enderror" placeholder="Masukkan Username" value="{{ old('username') }}" required>
                                        @error('username')
                                        <div class="invalid-feedback">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Masukkan Password" required>
                                        @error('password')
                                        <div class="invalid-feedback">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <button class="btn btn-success btn-user btn-block" id="btn-login" name="submit" type="submit">
                                        Login
                                    </button>
                                    <small><a href="/register">Register</a></small>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="jquery/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>