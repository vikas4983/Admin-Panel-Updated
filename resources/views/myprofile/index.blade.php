@extends('layouts.auth')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Cache-control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>


    </head>

    <body>
        @php
            $admin = Auth::guard('admin')->user();
        @endphp
        <div class="content-wrapper">
            <div class="content">
                <!-- Card Profile -->
                <div class="card card-default card-profile">

                    <div class="card-header-bg" style="background-image:url(asset('storage/admin/image/default.jpg') ">
                    </div>

                    <div class="card-body card-profile-body">

                        <div class="profile-avata">
                            @if ($admin && $admin->image ?? '')
                                <img class="rounded-circle" src="{{ asset('storage/admin/admin-images/' . $admin->image) }}"
                                    alt="Avata Image"
                                    style="width: 200px; height: 200px; overflow: hidden; border-radius: 50%;">
                            @else()
                                <img class="rounded-circle" src="{{ asset('storage/admin/image/default.jpg') }}"
                                    alt="Avata Image"
                                    style="width: 200px; height: 200px; overflow: hidden; border-radius: 50%;">
                            @endif
                            <a class="h5 d-block mt-3 mb-2" href="#">{{ $admin->name }}</a>
                            <a class="d-block text-color" href="#">{{ $admin->email }}</a>
                        </div>

                        <ul class="nav nav-profile-follow">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="h5 d-block">1503</span>
                                    <span class="text-color d-block">Friends</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="h5 d-block">2905</span>
                                    <span class="text-color d-block">Followers</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="h5 d-block">1200</span>
                                    <span class="text-color d-block">Following</span>
                                </a>
                            </li>

                        </ul>

                        <div class="profile-button">
                            <a class="btn btn-primary btn-pill" href="#">Upgrade Plan</a>

                        </div>



                    </div>

                    <div class="card-footer card-profile-footer">
                        <ul class="nav nav-border-top justify-content-center">
                            {{-- <li class="nav-item">
                        <a class="nav-link" href="user-profile.html">Settings</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user-activities.html">Activities</a>
                    </li> --}}

                            <li class="nav-item">
                                <a class="nav-link active" href="user-profile-settings.html"><i
                                        class="mdi mdi-home-account"></i> Profile</a>

                            </li>

                        </ul>
                    </div>

                </div>


                <div class="row">
                    <div class="col-xl-3">
                        <!-- Settings -->
                        <div class="card card-default">
                            <div class="card-header">
                                <h2>Settings</h2>
                            </div>

                            <div class="card-body pt-0">

                                <ul class="nav nav-settings">
                                    {{-- <li class="nav-item">
                                <a class="nav-link " href="user-profile-settings.html">
                                    <i class="mdi mdi-account-outline mr-1"></i> Profile
                                </a>
                            </li> --}}



                                    <li class="nav-item">
                                        <a class="nav-link " href="{{ route('myprofile.index') }}">
                                            <i class="mdi mdi-home-account mr-1" style="color:rgb(158,109,224) "></i>
                                            Profile
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('plan') }}">
                                            <i class="mdi mdi-currency-usd mr-1" style="color:rgb(158,109,224) "></i>
                                            Upgrade
                                        </a>
                                    </li>

                                   @if ($admin->image ?? '')
                                      <li class="nav-item">
                                        <a class="nav-link" button type="button" data-toggle="modal"
                                            data-target="#exampleModal">
                                           <i class="mdi mdi-delete mr-1" style="color:rgb(158,109,224) "></i> Delete
                                            Profile Picture
                                        </a>
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" class="text-danger" id="exampleModalLabel"
                                                            class="alert-danger text-black">
                                                            Alert!
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete your profile picture.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('myprofile.destroy', $admin->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-primary ">Ok</button>
                                                            <button type="button" class="btn btn-danger "
                                                                data-dismiss="modal">Cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                   @else
                                       
                                   @endif


                                    <li class="nav-item">
                                        <a class="nav-link " href="{{ route('profile.show') }}">
                                            <i class="mdi mdi-home-account mr-1" style="color:rgb(158,109,224) "></i>
                                            Two-Factor Authentication
                                        </a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link " href="http://localhost:8000/user/api-tokens">
                                            <i class="mdi mdi-home-account mr-1" style="color:rgb(158,109,224) "></i>
                                            API
                                        </a>
                                    </li> --}}
                                    {{-- <li class="nav-item">
                                <a class="nav-link" onclick="return confirm('Are you sure want to delete account?')" href="{{ url('admin_delete', $admin->id) }}">
                                <button>

                                    <i class="mdi mdi-delete mr-1"></i>
                                </button> Delete Profile
                                </a>
                                </li> --}}

                                    {{-- <li class="nav-item">
                                        <button type="button" data-toggle="modal" data-target="#exampleModal">

                                            <i class="mdi mdi-delete mr-1"></i> Delete Profile

                                        </button>

                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" class="text-danger" id="exampleModalLabel"
                                                            class="alert-danger text-black">
                                                            Alert!
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete your account.

                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ url('admin_delete', $admin->id) }}"><button
                                                                type="button"
                                                                class="btn btn-danger btn-pill">Ok</button></a>
                                                        <button type="button" class="btn btn-primary btn-pill"
                                                            data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </li> --}}


                                </ul>

                            </div>

                        </div>
                    </div>
                    <div class="col-xl-9">
                        <!-- Account Settings -->
                        <div class="card card-default">
                            <div class="card-header">
                                <h2 class="mb-5">Profile</h2>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <ul class="list-unstyled">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="accordion" id="accordionOne">
                                <div class="card">
                                    <div class="card-header" id="headingBorderOne">
                                        <h2>
                                            <a button class="btn btn-link collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseBorderOne"
                                                aria-expanded="false" aria-controls="collapseBorderOne">
                                                </i> <i class="mdi mdi-home-account"></i>Profile
                                            </a button>
                                        </h2>
                                    </div>
                                    <div id="collapseBorderOne" class="collapse" aria-labelledby="headingBorderOne"
                                        data-parent="#accordionOne">
                                        <div class="card-body">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{ $admin->name }}</th>
                                                        <th scope="col">{{ $admin->email }}</th>
                                                    </tr>

                                                </thead>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingBorderOne1">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapseBorderOne1" aria-expanded="false"
                                                aria-controls="collapseBorderOne1">
                                                </i><i class="mdi mdi-google-photos"></i>Update Image
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseBorderOne1" class="collapse" aria-labelledby="headingBorderOne1"
                                        data-parent="#accordionOne1">
                                        <div class="card-body">
                                            <form action="{{ route('myprofile.update', $admin->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-group mb-4">
                                                    <label for="lastName">Image</label>
                                                    <input type="file" name="image" class=" form-control"
                                                        value="{{ old('image') ?? $admin->image }}" id="lastName">
                                                </div>
                                                <div class="d-flex justify-content-end mt-6">
                                                    <button type="submit" class="btn btn-primary mb-2 btn-pill">Upload
                                                        Image
                                                    </button>

                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingBorderTwo">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapseBorderTwo" aria-expanded="false"
                                                aria-controls="collapseBorderTwo">
                                                <i class="mdi mdi-account-edit"></i> Update Profile

                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseBorderTwo" class="collapse" aria-labelledby="headingBorderTwo"
                                        data-parent="#accordionTwo">
                                        <div class="card-body">
                                            <form action="{{ route('myprofile.update', $admin->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('patch')

                                                {{-- <div class="form-group mb-4">
                                                    <label for="lastName">Image</label>
                                                    <input type="file" name="image" class=" form-control">
                                                </div>  --}}
                                                <div class="form-group mb-4">
                                                    <label for="lastName">Name</label>
                                                    <input type="text" name="name"
                                                        value="{{ old('name') ?? $admin->name }}" class=" form-control"
                                                        id="lastName">
                                                </div>


                                                <div class="form-group mb-4">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email"
                                                        value="{{ old('email') ?? $admin->email }}" class="form-control"
                                                        id="email">
                                                </div>
                                                <div class="d-flex justify-content-end mt-6">
                                                    <button type="submit" class="btn btn-primary mb-2 btn-pill">Update
                                                        Profile</button>

                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingBorderThree">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapseBorderThree" aria-expanded="false"
                                                aria-controls="collapseBorderThree">
                                                <i class="mdi mdi-key-change"></i>Change Password</button>
                                        </h2>
                                    </div>
                                    <div id="collapseBorderThree" class="collapse" aria-labelledby="headingBorderThree"
                                        data-parent="#accordionThree">



                                        <div class="card-body">
                                            <form action="{{ route('myprofile.update', $admin->id) }}" method="post">
                                                @csrf
                                                @method('PATCH')


                                                <div class="form-group mb-4">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" class=" form-control"
                                                        id="password">
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="Confirm Password">Confirm Password</label>
                                                    <input type="password" name="password_confirmation"
                                                        class="form-control" id="password_confirmation">
                                                </div>
                                                <div class="d-flex justify-content-end mt-6">
                                                    <button type="submit" class="btn btn-primary mb-2 btn-pill">Update
                                                        Password</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

</body>

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
@yield('scripts')
<!--  -->
</body>
<script>
    @if (Session::has('success'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "duration": 3000,
        }
        toastr.success("{{ session('success') }}");
    @endif

    @if (Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    @endif
    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,

        }
        toastr.info("{{ session('info') }}");
    @endif
</script>

<script>
    if (!Session::has)
        window.location.href = '/abc';
</script>




</html>
