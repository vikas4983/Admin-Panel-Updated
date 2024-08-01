@extends('layouts.auth');
@section('title', 'City | Admin')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <br>
            <h3 class="card-header">
                Create City </h3>
            <div class="card-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                       <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                        <li class="breadcrumb-item"> <a href="{{ route('cities.index') }}">City</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add City</li>
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

                <form action="{{ route('cities.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>State</label>
                        <select name="state_id" id="" class="form-control">

                            @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ $state->state }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="name" class="form-control" name="city" placeholder="Enter City Name">
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

                    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                    <x-submit-button-component 
                      buttonStyle="$buttonStyle->buttonStyle"
                      content="Create City"
                      />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
