@extends('layouts.auth');
@section('title', 'Admin - Add | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item"> <a href="{{ route('admins.index') }}">Admin</a> </li>

                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-body">
                    {{-- Display Error Msg --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- Display Success Msg --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('admins.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label> Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="form-group">
                            <label> Name</label>
                            <input type="name" class="form-control" name="name" placeholder="Enter Admin Name">
                        </div>
                        <div class="form-group">
                            <label> Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Admin Email">
                        </div>
                        <div class="form-group">
                            <label> Password</label>
                            <input type="password" name="password" class="form-control input-lg" id="password"
                                placeholder="Password" autofocus autocomplete="password">

                        </div>
                        <label> Confirm Password</label>
                        <div class="form-group">
                            <input type="password" name="password_confirmation" class=" form-control input-lg"
                                id="cpassword" placeholder="Confirm Password" autofocus
                                autocomplete="password_confirmation">


                        </div>

                        {{-- <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div> --}}

                       <div><label>Status</label></div>
                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            
                            <input type="radio" id="customRadio1" name="status" class="custom-control-input"
                                 value="1">
                            <label class="custom-control-label" for="customRadio1">Active</label>
                        </div>

                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio2" name="status" class="custom-control-input" checked="checked" value="0">
                            <label class="custom-control-label" for="customRadio2">InActive</label>
                        </div>



                        <button type="submit" class="btn btn-primary">Submit</button>
                        {{-- <x-submit-button-component buttonStyle="$buttonStyle->buttonStyle" content="Create Admin" /> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
