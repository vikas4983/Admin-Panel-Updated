@extends('layouts.auth');
@section('title', 'Site Setting - Edit | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                              <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item"> <a href="{{ route('siteSettings.index') }}">Site Setting</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Site Setting >
                                {{ $siteSetting->name }}</li>
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
                    <form action="{{ route('siteSettings.update', $siteSetting->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label> Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Site Name"
                                    value="{{ old('name') ?? $siteSetting->name }}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter  Site Title "
                                    value="{{ old('title') ?? $siteSetting->title }}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Description</label>
                                <input type="text" class="form-control" name="description"
                                    placeholder="Enter Description "
                                    value="{{ old('description') ?? $siteSetting->description }}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Number</label>
                                <input type="text" class="form-control" name="number" placeholder="Enter Number "
                                    value="{{ old('number') ?? $siteSetting->number }}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter Email "
                                    value="{{ old('email') ?? $siteSetting->email }}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Google Analytics Code</label>
                                <input type="text" class="form-control" name="google_analytics_code"
                                    placeholder="Enter Google Analytics Code "
                                    value="{{ old('google_analytics_code') ?? $siteSetting->google_analytics_code }}"
                                    required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Footer Description</label>
                                <input type="text" class="form-control" name="footer"
                                    placeholder="Enter Footer Description "
                                    value="{{ old('footer') ?? $siteSetting->footer }}" required>
                            </div>

                            {{-- <div class="form-group col-lg-6">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="1"
                                        {{ old('status', $siteSetting->status) == 'Active' ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0"
                                        {{ old('status', $siteSetting->status) == 'Inactive' ? 'selected' : '' }}>
                                        InActive</option>
                                </select>
                            </div> --}}
                            <div><label class="mr-3">Status</label></div>
                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio1" name="status" class="custom-control-input"
                                value="1" {{$siteSetting->status == 'Active' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="customRadio1">Active</label>
                        </div>

                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio2" name="status" class="custom-control-input"
                                value="0" {{ $siteSetting->status == 'Inactive' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio2">Inactive</label>
                        </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            {{-- <x-submit-button-component 
                      buttonStyle="$buttonStyle->buttonStyle"
                      content="Update Site Setting "
                      /> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
