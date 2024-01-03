<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Page</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('template/assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('template/assets/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    {{-- LOGO --}}
                                    <img src="{{ asset('template/assets/images/logos/logo-rental-alat.png') }}" width="180"
                                        alt="">
                                </a>
                                <form action="{{ route('daftar') }}" method="post">
                                    @csrf
                                    <div class="mb-1">
                                        <label for="namaInput" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="namaInput" name="nama"
                                            aria-describedby="textHelp">
                                    </div>
                                    <div class="mb-1">
                                        <label for="emailInput" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="emailInput" name="email"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-1">
                                        <label for="usernameInput" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="usernameInput" name="username"
                                            aria-describedby="usernameHelp">
                                    </div>
                                    <div class="mb-1">
                                        <label for="teleponInput" class="form-label">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="teleponInput" name="nomortelepon"
                                            aria-describedby="teleponHelp">
                                    </div>
                                    <div class="mb-2">
                                        <label for="passwordInput" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="passwordInput" name="password">
                                    </div>
                                    {{-- <div class="mb-1">
                    <label for="divisiInput" class="form-label">Divisi</label>
                    <input type="text" class="form-control" id="divisiInput" name="divisi" aria-describedby="divisiHelp">
                  </div> --}}
                                    <button type="submit"
                                        class="btn btn-primary w-100 py-8 fs-4 mb-2 rounded-2">Daftar</button>
                                </form>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-bold">Sudah memiliki akun?</p>
                                    <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Masuk</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('template/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
