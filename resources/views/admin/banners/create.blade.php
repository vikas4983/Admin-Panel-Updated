@extends('layouts.auth')

@section('title', 'Banner - Create | Admin')

@section('content')
    <div class="row justify-content-center align-items-center mb-3" style="height: 80vh;">
    <div class="col-lg-6">
        <div class="card card-default mt-3">
            <div class="card-header ">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                        <li class="breadcrumb-item"> <a href="{{ route('banners.index') }}">Banner</a> </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Banner</li>
                    </ol>
                </nav>
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

                    <form action="{{ route('banners.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label> Upload Banner</label>
                            <div>
                                {{-- <img src="{{ asset('storage/admin/logo-favicon/' . $data->logo ?? '') }}" alt="Logo" width="450px" height="270px"> --}}
                            </div>
                            <input type="file" class="form-control" name="banner">
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
                            <input type="radio" id="customRadio2" name="status" class="custom-control-input"
                                checked="checked" value="0">
                            <label class="custom-control-label" for="customRadio2">InActive</label>
                        </div>

                        {{-- <button type="submit" class="btn btn-primary">Upload Banner</button> --}}
                        <x-submit-button-component buttonStyle="$buttonStyle->buttonStyle" content="Upload Banner" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
