@extends('layouts.auth')
@section('title', 'Members | Admin')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <body class="navbar-fixed sidebar-fixed" id="body">
        <script>
            NProgress.configure({
                showSpinner: false
            });
            NProgress.start();
        </script>



        <!-- ====================================
                                                                                                                                                        ——— WRAPPER
                                                                                                                                                        ===================================== -->
        <div class="wrapper">
            <div class="content-wrapper">
                <div class="content"><!-- For Components documentaion -->
                    <div class="row">
                        {{-- <div class="col-xl-4">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h2>Progress</h2>
                                </div>

                                <div class="card-body pt-3 pb-4">
                                    <div class="circle circle-lg" data-size="200" data-value="0.83" data-thickness="20"
                                        data-fill="{
                                      &quot;color&quot;: &quot;#35D00E&quot;
                                             }">
                                        <div class="circle-content">
                                            <h2 class="text-uppercase font-weight-bold">83%</h2>

                                            <strong></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
 <div class="col-xl-8">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h2>Team Activity</h2>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> All time
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="javascript:void(0)">1 Day ago</a>
                                            <a class="dropdown-item" href="javascript:void(0)">7 Day ago</a>
                                            <a class="dropdown-item" href="javascript:void(0)">15 Day ago</a>
                                            <a class="dropdown-item" href="javascript:void(0)">1 month ago</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" data-simplebar style="height: 241px;">
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-action border-0">
                                            <div class="media media-xs mb-0">
                                                <div class="media-xs-wrapper bg-primary">
                                                    <i class="mdi mdi-star-outline"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span class="title">Emma Smith</span>
                                                    <p>Extremity sweetness difficult behaviour he of. On disposal of as
                                                        landlord horrible. Afraid at highly months
                                                        do things
                                                        on at.</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        @foreach ($admins as $admin)
                            <div class="col-lg-4 col-xl-4 col-xxl-4">
                                <div class="card card-default mt-7">
                                    <div class="card-body">
                                        <a class="d-block mb-2" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#modal-contact">
                                            <div class="image mb-3 d-inline-flex mt-n8">
                                                <img src="{{ asset('storage/admin/admin-images/' . $admin->image) }}"
                                                    class="img-fluid rounded-circle d-inline-block" alt="Avatar Image"
                                                    width="100px" width="70px">
                                            </div>
                                            <h5 class="card-title">{{ $admin->name ?? '' }} (MM{{ $admin->id }}) <i
                                                    class="mdi mdi-security"> </i>
                                                <i class=" mdi mdi-chess-queen"></i> <i class="mdi mdi-eye"></i>
                                            </h5>
                                        </a>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col">
                                                    <ul class="list-unstyled d-inline-block mb-5">
                                                        <li class="d-flex mb-1">
                                                            <i class="mdi mdi-gmail mr-1"></i>
                                                            <span>{{ $admin->email ?? '' }}</span>
                                                        </li>
                                                        <li class="d-flex">
                                                            <i class="mdi mdi-phone mr-1"></i>
                                                            <span>{{ $admin->mobile ?? '' }}</span>
                                                        </li>
                                                        @if ($admin->roll === 'Admin')
                                                            <li class="d-flex">
                                                                <i class="mdi mdi-account mr-1"></i>
                                                                <span>{{ $admin->roll }}</span>
                                                            </li>
                                                        @else
                                                            <li class="d-flex">
                                                                <i class="mdi mdi-account mr-1"></i>
                                                                <span>{{ $admin->roll }}</span>
                                                            </li>
                                                        @endif
                                                        @if ($admin->status === 'Active')
                                                            <li class="d-flex">
                                                                <i class="mdi mdi-thumb-up mr-1"></i>
                                                                <span>{{ $admin->status }}</span>
                                                            </li>
                                                        @else
                                                            <li class="d-flex">
                                                                <i class="mdi mdi-thumb-down mr-1"></i>
                                                                <span>{{ $admin->status }}</span>
                                                            </li>
                                                        @endif

                                                    </ul>
                                                </div>

                                            </div>
                                            <div class="btn-group d-flex flex-row justify-content-between " role="group"
                                                aria-label="Basic example" style="width: 50px">
                                                <button type="button" data-toggle="modal"
                                                    data-target="#exampleModal{{ $admin->id }}">
                                                    <i class="fas fa-edit mr-3 mb-3 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle"
                                                        style="color"></i>
                                                </button>
                                                <form action="{{ route('admins.destroy', $admin->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="mr-1 mb-3 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle ">
                                                        <i class="fas fa-trash" style="color:red"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="modal fade" id="exampleModal{{ $admin->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel{{ $admin->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-header d-flex justify-content-center">
                                                            <h5 class="modal-title"
                                                                id="exampleModalLabel{{ $admin->id }}">Admin Update</h5>
                                                            <button type="button" class="close position-absolute"
                                                                style="right: 1rem;" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>


                                                        <div class="modal-body">
                                                            <form id="adminForm"
                                                                action="{{ route('admins.update', $admin->id) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="admin_id"
                                                                    value="{{ $admin->id ?? '' }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div class="row ">
                                                                    <div class="form-group col-lg-6">
                                                                        <label for="image"> Image</label>
                                                                        <input type="file" name="image"
                                                                            class=" form-control input-lg" id="image"
                                                                            aria-describedby="nameHelp"
                                                                            value="{{ $admin->image ?? '' }}">

                                                                    </div>
                                                                    <div class="form-group col-lg-6  mb-4">
                                                                        <label for="name"> Name</label>
                                                                        <input type="text" name="name"
                                                                            value="{{ $admin->name ?? '' }}"
                                                                            class=" form-control input-lg"
                                                                            @error('name'){{ Session::has('error') }} @enderror
                                                                            id="name" aria-describedby="nameHelp"
                                                                            placeholder="Name">
                                                                        @error('name')
                                                                            <p>{{ Session::has('error') }}</p>
                                                                        @enderror

                                                                    </div>
                                                                    <div class="form-group col-lg-6 mb-4">
                                                                        <label for="email"> Email</label>
                                                                        <input type="email" name="email"
                                                                            value="{{ $admin->email ?? '' }}"
                                                                            class="form-control input-lg" id="email"
                                                                            aria-describedby="emailHelp"
                                                                            placeholder="Username">
                                                                    </div>
                                                                    <div class="form-group col-lg-6 mb-4">
                                                                        <label for="number"> Mobile Number</label>
                                                                        <input type="text" name="mobile"
                                                                            class="form-control input-lg" id="mobile"
                                                                            placeholder="Mobile Number"
                                                                            value="{{ $admin->mobile ?? '' }}">

                                                                    </div>
                                                                    <div class="form-group col-lg-6">
                                                                        <label for="password">Password</label>
                                                                        <input type="password" name="password"
                                                                            class="form-control @error('password') is-invalid @enderror"
                                                                            id="password" placeholder="Password">
                                                                        @error('password')
                                                                            <p class="invalid-feedback">{{ $message }}
                                                                            </p>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group col-lg-6">
                                                                        <label for="confirm-password">Confirm
                                                                            Password</label>
                                                                        <input type="password"
                                                                            name="password_confirmation"
                                                                            class="form-control @error('password') is-invalid @enderror"
                                                                            id="cpassword" placeholder="Confirm Password">
                                                                        @error('password')
                                                                            <p class="invalid-feedback">{{ $message }}
                                                                            </p>
                                                                        @enderror
                                                                        <p id="password-error-message"
                                                                            class="invalid-feedback"
                                                                            style="display: none;">Confirmation Passwords
                                                                            do not match!
                                                                        </p>
                                                                    </div>

                                                                    <div class="form-group col-lg-6">
                                                                        <div><label class="mr-3">Roll</label></div>
                                                                        <select name="status" class="form-control"
                                                                            id="status">
                                                                            <option value="1"
                                                                                {{ $admin->roll == 'Admin' ? 'selected' : '' }}>
                                                                                Admin</option>
                                                                            <option value="0"
                                                                                {{ $admin->roll == 'Sub-Admin' ? 'selected' : '' }}>
                                                                                Sub-Admin</option>
                                                                        </select>

                                                                    </div>

                                                                    <div class="form-group col-lg-6 mb-4">
                                                                        <div><label class="mr-3">Status</label></div>
                                                                        <select name="status" class="form-control"
                                                                            id="status">
                                                                            <option value="1"
                                                                                {{ $admin->status == 'Active' ? 'selected' : '' }}>
                                                                                Active</option>
                                                                            <option value="0"
                                                                                {{ $admin->status == 'Inactive' ? 'selected' : '' }}>
                                                                                InActive</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="d-flex justify-content-between mb-3">
                                                                        </div>
                                                                        <div class="text-center">
                                                                            <button type="submit" id="adminFormBtn"
                                                                                class="btn btn-primary mb-4">
                                                                                Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        {{-- <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-pill">Save Changes</button>
      </div> --}}
                                                    </div>
                                                </div>
                                            </div>





                                            {{-- <div class="row justify-content-center">
                                        <div class="col-4 px-1">
                                            <div class="circle" data-size="60" data-value="0.90" data-thickness="4"
                                                data-fill="{
                &quot;color&quot;: &quot;#35D00E&quot;
              }">
                                                <div class="circle-content">
                                                    <h6 class="text-uppercase">html</h6>
                                                    <h6>90%</h6>
                                                    <strong></strong>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4 px-1">
                                            <div class=" circle" data-size="60" data-value="0.65" data-thickness="4"
                                                data-fill="{
                &quot;color&quot;: &quot;#fec400&quot;
              }">
                                                <div class="circle-content">
                                                    <h6 class="text-uppercase">css</h6>
                                                    <h6>65%</h6>
                                                    <strong></strong>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4 px-1">
                                            <div class=" circle" data-size="60" data-value="0.35" data-thickness="4"
                                                data-fill="{
                &quot;color&quot;: &quot;#fe5461&quot;
              }">
                                                <div class="circle-content">
                                                    <h6 class="text-uppercase">js</h6>
                                                    <h6>25%</h6>
                                                    <strong></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- Contact Modal -->
                        <div class="modal fade" id="modal-contact" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-end border-bottom-0">
                                        <button type="button" class="btn-edit-icon" data-dismiss="modal"
                                            aria-label="Close">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>

                                        <div class="dropdown">
                                            <button class="btn-dots-icon" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>

                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="javascript:void(0)">Action</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Something else
                                                    here</a>
                                            </div>
                                        </div>

                                        <button type="button" class="btn-close-icon" data-dismiss="modal"
                                            aria-label="Close">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </div>

                                    <div class="modal-body pt-0">
                                        <div class="row no-gutters">
                                            <div class="col-md-6">
                                                <div class="profile-content-left px-4">
                                                    <div class="card text-center px-0 border-0">
                                                        <div class="card-img mx-auto">
                                                            <img class="rounded-circle" src="images/user/u6.jpg"
                                                                alt="user image">
                                                        </div>

                                                        <div class="card-body">
                                                            <h4 class="py-2">Albrecht Straub</h4>
                                                            <p>Albrecht.straub@gmail.com</p>
                                                            <a class="btn btn-primary btn-pill btn-lg my-4"
                                                                href="javascript:void(0)">Follow</a>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-between ">
                                                        <div class="text-center pb-4">
                                                            <h6 class="pb-2">1503</h6>
                                                            <p>Friends</p>
                                                        </div>

                                                        <div class="text-center pb-4">
                                                            <h6 class="pb-2">2905</h6>
                                                            <p>Followers</p>
                                                        </div>

                                                        <div class="text-center pb-4">
                                                            <h6 class="pb-2">1200</h6>
                                                            <p>Following</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="contact-info px-4">
                                                    <h4 class="mb-1">Contact Details</h4>
                                                    <p class="text-dark font-weight-medium pt-4 mb-2">Email address</p>
                                                    <p>Albrecht.straub@gmail.com</p>
                                                    <p class="text-dark font-weight-medium pt-4 mb-2">Phone Number</p>
                                                    <p>+99 9539 2641 31</p>
                                                    <p class="text-dark font-weight-medium pt-4 mb-2">Birthday</p>
                                                    <p>Nov 15, 1990</p>
                                                    <p class="text-dark font-weight-medium pt-4 mb-2">Event</p>
                                                    <p>Lorem, ipsum dolor</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Footer -->
                {{-- <footer class="footer mt-auto">
            <div class="copyright bg-white">
              <p>
                &copy; <span id="copy-year"></span> Copyright Mono Dashboard Bootstrap Template by <a class="text-primary" href="http://www.iamabdus.com/" target="_blank" >Abdus</a>.
              </p>
            </div>
            <script>
                var d = new Date();
                var year = d.getFullYear();
                document.getElementById("copy-year").innerHTML = year;
            </script>
          </footer> --}}

            </div>
        </div>





        <!-- Card Offcanvas -->
        {{-- <div class="card card-offcanvas" id="contact-off" >
                      <div class="card-header">
                        <h2>Contacts</h2>
                        <a href="#" class="btn btn-primary btn-pill px-4">Add New</a>
                      </div>
                      <div class="card-body">

                        <div class="mb-4">
                          <input type="text" class="form-control form-control-lg form-control-secondary rounded-0" placeholder="Search contacts...">
                        </div>

                        <div class="media media-sm">
                          <div class="media-sm-wrapper">
                            <a href="user-profile.html">
                              <img src="images/user/user-sm-01.jpg" alt="User Image">
                              <span class="active bg-primary"></span>
                            </a>
                          </div>
                          <div class="media-body">
                            <a href="user-profile.html">
                              <span class="title">Selena Wagner</span>
                              <span class="discribe">Designer</span>
                            </a>
                          </div>
                        </div>

                        <div class="media media-sm">
                          <div class="media-sm-wrapper">
                            <a href="user-profile.html">
                              <img src="images/user/user-sm-02.jpg" alt="User Image">
                              <span class="active bg-primary"></span>
                            </a>
                          </div>
                          <div class="media-body">
                            <a href="user-profile.html">
                              <span class="title">Walter Reuter</span>
                              <span>Developer</span>
                            </a>
                          </div>
                        </div>

                        <div class="media media-sm">
                          <div class="media-sm-wrapper">
                            <a href="user-profile.html">
                              <img src="images/user/user-sm-03.jpg" alt="User Image">
                            </a>
                          </div>
                          <div class="media-body">
                            <a href="user-profile.html">
                              <span class="title">Larissa Gebhardt</span>
                              <span>Cyber Punk</span>
                            </a>
                          </div>
                        </div>

                        <div class="media media-sm">
                          <div class="media-sm-wrapper">
                            <a href="user-profile.html">
                              <img src="images/user/user-sm-04.jpg" alt="User Image">
                            </a>

                          </div>
                          <div class="media-body">
                            <a href="user-profile.html">
                              <span class="title">Albrecht Straub</span>
                              <span>Photographer</span>
                            </a>
                          </div>
                        </div>

                        <div class="media media-sm">
                          <div class="media-sm-wrapper">
                            <a href="user-profile.html">
                              <img src="images/user/user-sm-05.jpg" alt="User Image">
                              <span class="active bg-danger"></span>
                            </a>
                          </div>
                          <div class="media-body">
                            <a href="user-profile.html">
                              <span class="title">Leopold Ebert</span>
                              <span>Fashion Designer</span>
                            </a>
                          </div>
                        </div>

                        <div class="media media-sm">
                          <div class="media-sm-wrapper">
                            <a href="user-profile.html">
                              <img src="images/user/user-sm-06.jpg" alt="User Image">
                              <span class="active bg-primary"></span>
                            </a>
                          </div>
                          <div class="media-body">
                            <a href="user-profile.html">
                              <span class="title">Selena Wagner</span>
                              <span>Photographer</span>
                            </a>
                          </div>
                        </div>

                      </div>
                    </div> --}}





        <!--  -->



        



    </body>
@endsection
