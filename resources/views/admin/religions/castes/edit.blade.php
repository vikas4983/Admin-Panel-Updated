@extends('layouts.auth');
@section('title', 'Caste - Edit | Admin')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                          <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                        <li class="breadcrumb-item"> <a href="{{ route('castes.index') }}">Caste</a> </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Caste > {{ $caste->caste }}</li>
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

                <form action="{{ route('castes.update', $caste->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label>Religion</label>
                        <select name="religion_id" id="religion_id" class="form-control">
                            @foreach ($religions as $religion)
                            <option value="{{ $religion->id }}" {{ old('religion_id', $caste->religion_id) == $religion->id ? 'selected' : '' }}>
                                {{ $religion->religion }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Caste</label>
                        <input class="form-control" value="{{ old('caste') ?? $caste->caste }}" name="caste" placeholder="Enter Caste Name">
                    </div>
                    {{-- <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="1" {{ old('status', $caste->status) == 1 ? 'selected' : '' }}>Active
                            </option>
                            <option value="0" {{ old('status', $caste->status) == 0 ? 'selected' : '' }}>Deactive
                            </option>

                        </select>
                    </div> --}}
                    <div><label>Status</label></div>
                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio1" name="status" class="custom-control-input"
                                value="1" {{$caste->status == 'Active' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="customRadio1">Active</label>
                        </div>

                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio2" name="status" class="custom-control-input"
                                value="0" {{ $caste->status == 'Inactive' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio2">Inactive</label>
                        </div>
                    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                    <x-submit-button-component 
                      buttonStyle="$buttonStyle->buttonStyle"
                      content="Upadte Caste "
                      />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
