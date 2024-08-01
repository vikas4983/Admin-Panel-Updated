@extends('layouts.auth');
@section('title', 'Email Setting - Create | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default ">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item"> <a href="{{ route('emailSettings.index') }}">Email Setting</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Email Setting</li>
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
                    {{-- @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif --}}


                    <form action="{{ route('emailSettings.store') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label> Host</label>
                                <input type="text" class="form-control" name="host" placeholder="Enter Host Name"
                                    value="{{ old('host') }}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>From Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter  Email "
                                    value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Password</label>
                                <input type="text" class="form-control" name="password" placeholder="Enter Password "
                                    value="{{ old('password') }}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Port</label>
                                <input type="text" class="form-control" name="port" placeholder="Enter Port Number "
                                    value="{{ old('port') }}" required>
                            </div>
                            {{-- <div class="form-group col-lg-6">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div> --}}
                           
                             <div><label class="mr-3">Status</label></div>
                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            
                            <input type="radio" id="customRadio1" name="status" class="custom-control-input"
                                 value="1">
                            <label class="custom-control-label" for="customRadio1">Active</label>
                        </div>

                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio2" name="status" class="custom-control-input" checked="checked" value="0">
                            <label class="custom-control-label" for="customRadio2">InActive</label>
                        </div>

                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                             {{-- <x-submit-button-component 
                      buttonStyle="$buttonStyle->buttonStyle"
                      content="Create Email Setting"
                      /> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
