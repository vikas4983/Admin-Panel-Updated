@extends('layouts.auth');
@section('title', 'Email Setting - Edit | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                              <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item"> <a href="{{ route('emailSettings.index') }}">Email Setting</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Menu > {{ $emailSetting->name }}</li>
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
                    <form action="{{ route('emailSettings.update', $emailSetting->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label> Host</label>
                                <input type="text" class="form-control" name="host"
                                    value="{{ old('host') ?? $emailSetting->host }}" placeholder="Enter Host Name"
                                     required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label> Email</label>
                                <input type="text" class="form-control" name="email"
                                    value="{{ old('email') ?? $emailSetting->email }}" placeholder="Enter Email"
                                   required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label> Password</label>
                                <input type="text" class="form-control" name="password"
                                    value="{{ old('password') ?? $emailSetting->password }}" placeholder="Enter Password"
                                     required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label> Port</label>
                                <input type="text" class="form-control" name="port"
                                    value="{{ old('port') ?? $emailSetting->port }}" placeholder="Enter Port"
                                     required>
                            </div>
                            {{-- <div class="form-group col-lg-6">
                                <label>Status</label>
                                  
                                <select name="status" class="form-control" required>
                                  <option value="1" {{ old('status', $emailSetting->status) == 'Active' ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" {{ old('status', $emailSetting->status) == 'Inactive' ? 'selected' : '' }}>
                                        InActive</option>
                                </select>
                            </div> --}}
                            <div><label class="mr-3">Status</label></div>
                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio1" name="status" class="custom-control-input"
                                value="1" {{$emailSetting->status == 'Active' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="customRadio1">Active</label>
                        </div>

                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio2" name="status" class="custom-control-input"
                                value="0" {{ $emailSetting->status == 'Inactive' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio2">Inactive</label>
                        </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                             {{-- <x-submit-button-component 
                      buttonStyle="$buttonStyle->buttonStyle"
                      content="Update Email Setting"
                      /> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
