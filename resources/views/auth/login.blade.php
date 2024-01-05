<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
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
                                    <img src="{{ asset('template/assets/images/logos/logo-rental-alat.png') }}"
                                        width="180" alt="">
                                </a>
                                <p class="text-center">LOGIN</p>
                                <form action="{{ route('masuk') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="inputUsername" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="inputUsername" name="username"
                                            aria-describedby="usernameHelp">
                                    </div>
                                    <div class="mb-4">
                                        <label for="inputPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="inputPassword" name="password">
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Masuk</button>
                                    @if (session()->has('error'))
                                        <div class="alert alert-danger m-0">
                                            <ul>
                                                <li>{{ session('error') }}</li>
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Pengguna Baru?</p>
                                        <a class="text-primary fw-bold ms-2" href="{{ route('registerPage') }}">Buat
                                            Akun</a>
                                    </div>
                                    {{-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                          <li>Masuk</li>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @else
                                    <div class="alert alert-danger">
                                      <ul>
                                        <li>Coba</li>
                                          @foreach ($errors->all() as $error)
                                              <li>{{ $error }}</li>
                                          @endforeach
                                      </ul>
                                  </div> --}}
                                    {{-- @endif --}}
                                </form>
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
