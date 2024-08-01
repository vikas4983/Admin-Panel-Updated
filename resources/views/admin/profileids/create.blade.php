@extends('layouts.auth');
@section('title', 'ProfileId - Create | Admin')
@section('content')
    <div class="content-wrapper ">
        <div class="content ">
            <div class="row justify-content-center">
                <div class="card card-default col-lg-8 ">
                    <div class="card-header">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                                <li class="breadcrumb-item"> <a href="{{ route('profileids.index') }}">Profile Id</a> </li>
                                <li class="breadcrumb-item active" aria-current="page">Add ProfileId</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card card-default col-lg-8 mx-auto">
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
                        <form action="{{ Route('profileids.store') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label> Name</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Enter ProfileId Name" value="{{ old('name') }}" required>
                                </div>

                                {{-- <div class="form-group col-lg-6">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div> --}}
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
                                {{-- <x-submit-button-component buttonStyle="$buttonStyle->buttonStyle"
                                    content="Create Profile Id " /> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
