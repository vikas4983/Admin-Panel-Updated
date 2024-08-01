@extends('layouts.auth');
@section('title', 'Occupations | Admin')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card card-default">
                <h3 class="card-header">
                    Create Occupation</h3>
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                        <li class="breadcrumb-item"> <a href="{{ route('occupations.index') }}">Occupation</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Occupation</li>
                        </ol>
                    </nav>
                </div>

                {{-- <div class="card-header">
                    <div class="btn-group mb-1">
                        <button type="button" class="btn btn-primary">Action </button>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('occupations.index') }}">View Occupation</a>
                {{-- <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a> 
                </div>
                </div>
                </div> --}}

                {{-- <div class="card card-default">
                        <div class="card-header">
                            <a button href="{{ route('occupations.index') }}" type="button" class="btn btn-primary">View
                Occupation</button></a>

                <button type="button" class="btn btn-secondary">Secondary</button>

                <button type="button" class="btn btn-success">Success</button>

                <button type="button" class="btn btn-danger">Danger</button>

                <button type="button" class="btn btn-warning">Warning</button>

                <button type="button" class="btn btn-info">Info</button>
            </div>
        </div> --}}
    </div>
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

        <form action="{{ route('occupations.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Employee Type</label>
                <select name="employee_id" id="" class="form-control">

                    @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->employee }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Occupation</label>
                <input type="text" class="form-control" name="occupation" placeholder="Enter Occupation Name">
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
                      content="Update Occupation"
                      />
        </form>
    </div>
</div>
</div>
</div>
@endsection
