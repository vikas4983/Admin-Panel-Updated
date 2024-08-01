@extends('layouts.auth');
@section('title', 'Menu - Edit | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content mt-3 ">
            <div class="row justify-content-center">
                <div class="card card-default col-lg-6 ">
                    <div class="card-header">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                                <li class="breadcrumb-item"> <a href="{{ route('menus.index') }}">Menu</a> </li>
                                <li class="breadcrumb-item active" aria-current="page">Add Menu</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card card-default col-lg-6 mx-auto"> <!-- Add mx-auto class here -->
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
                        <form action="{{ route('menus.store') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Menu Name"
                                        value="{{ old('name') ?? $menu->name }}" required>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Url</label>
                                    <input type="text" class="form-control" name="url" placeholder="Enter Url "
                                        value="{{ old('url') ?? $menu->name }}" required>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Section</label>
 
                                    <select name="section" class="form-control" required>
                                       
                                        <option value="1"
                                            {{ old('section', $menu->section) == 'Header' ? 'selected' : '' }}>Header</option>
                                        <option value="0"
                                            {{ old('section', $menu->section) == 'Footer' ? 'selected' : '' }}>Footer</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div><label>Status</label></div>
                                    <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                        <input type="radio" id="customRadio1" name="status" class="custom-control-input"
                                            value="1">
                                        <label class="custom-control-label " for="customRadio1">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                        <input type="radio" id="customRadio2" name="status" class="custom-control-input"
                                            checked="checked" value="0">
                                        <label class="custom-control-label " for="customRadio2">InActive</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                {{-- <x-submit-button-component buttonStyle="$buttonStyle->buttonStyle" content="Create Menu" /> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
