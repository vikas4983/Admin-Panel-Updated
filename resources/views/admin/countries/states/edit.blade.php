@extends('layouts.auth');
@section('title', 'State - Edit | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                             <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item"> <a href="{{ route('states.index') }}">State</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit State > {{ $state->state }}</li>
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

                    <form action="{{ route('states.update', $state->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>Country</label>
                            <select name="country_id" id="country_id" class="form-control">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ old('country_id', $state->country_id) == $country->id ? 'selected' : '' }}>
                                        {{ $country->country }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input class="form-control" value="{{ old('state') ?? $state->state }}" name="state"
                                placeholder="Enter State Name">
                        </div>
                        {{-- <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="1" {{ old('status', $state->status) == 1 ? 'selected' : '' }}>Active
                                </option>
                                <option value="0" {{ old('status', $state->status) == 0 ? 'selected' : '' }}>Deactive
                                </option>

                            </select>
                        </div> --}}
                        <div><label>Status</label></div>
                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio1" name="status" class="custom-control-input"
                                value="1" {{$state->status == 'Active' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="customRadio1">Active</label>
                        </div>

                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio2" name="status" class="custom-control-input"
                                value="0" {{ $state->status == 'Inactive' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio2">Inactive</label>
                        </div>
                        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                        <x-submit-button-component 
                      buttonStyle="$buttonStyle->buttonStyle"
                      content="Update State"
                      />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
