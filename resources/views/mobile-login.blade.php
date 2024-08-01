<!DOCTYPE html>



<html lang="en">

<head>

    <head>
        <meta name="theme-name" content="mono" />

        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
        <link href="{{ asset('assets/auth/plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/auth/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

        <!-- PLUGINS CSS STYLE -->
        <link href="{{ asset('assets/auth/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />

        @yield('styles') @yield('font-awesome-cdn')
        <link href="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}"
            rel="stylesheet" />



        <link href="{{ asset('assets/auth/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />



        <link href="{{ asset('assets/auth/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />



        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">



        <link href="{{ asset('assets/auth/plugins/toaster/toastr.min.css') }}" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

        <!-- MONO CSS -->
        <link id="main-css-href" rel="stylesheet" href="{{ asset('assets/auth/css/style.css') }}" />




        <!-- FAVICON -->
        <link href="{{ asset('assets/auth/images/favicon.png') }}" rel="shortcut icon" />

        <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
        <script src="{{ asset('assets/auth/plugins/nprogress/nprogress.js') }}"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
     alpha/css/bootstrap.css"
            rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <style>
            .modal-header {
                border-bottom: none;
            }
        </style>

    </head>
</head>
<body class="bg-light-gray" id="body">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
        <div class="d-flex flex-column justify-content-between">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-10">
                    <div class="card card-default mb-0">
                        <div class="card-header pb-0">
                            <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                                <a class="w-auto pl-0" href="{{ route('login') }}">
                                    <img src="https://mangalmandap.com/images/mangal_logo.jpg" height="70px"
                                        width="800px" alt="Mono">
                                    <span class="brand-name text-dark"></span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-5 pb-5 pt-0">

                            <h4 class="text-dark mb-6 text-center"></h4>
                            @if ($errors->any())
                                <div>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ url('send-otp') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                        <label for="mobile-email">Mobile No. / Email ID
                                        </label>
                                        <input type="text" name="mobile" value="{{ old('mobile') }}"
                                            class="form-control col-lg-12" id="mobile" aria-describedby="mobileHelp"
                                            placeholder="Enter Mobile Number Or Email">
                                    </div>
                                    <div class="text-center w-100">
                                        <button type="submit" class="btn btn-primary btn-pill mb-4">Send OTP
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between mb-3">
                                    <div class="custom-control custom-checkbox mr-3 mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                        <label class="custom-control-label" for="customCheck2">Remember
                                            me</label>
                                    </div>

                                    <a class="text-color" href="#"> Forgot password? </a>

                                </div>
                                <p class="mt-3">Don't have an account yet ?
                                    <a class="text-blue" href="{{ url('admin-create') }}">Sign Up</a>

                                </p>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
