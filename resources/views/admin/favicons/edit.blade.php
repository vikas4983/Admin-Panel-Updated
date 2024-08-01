@extends('layouts.auth');
@section('title', 'Favicon - Edit | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                              <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item"> <a href="{{ route('logos.index') }}">Favicon</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Favicon
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

           @if($favicon)
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

                    {{-- @dump($logofavicon) --}}
                    <form action="{{ route('favicons.update', $favicon->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            
                            <img src="{{asset('storage/admin/logo-favicon/favicons/'.($favicon->name ?? ''))}}" alt="" style="margin-left: 604px;
                                                padding:;
                                                max-height: 70px;
                                                margin-top: -14px;
                                                margin-bottom: -37px;
                                                ">
                        </div>
                        <div class="form-group">
                            <label>Upload New Favicon </label>
                            <input type="file" class="form-control" name="favicon">
                        </div>
                        {{-- <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="1" {{ old('status', $favicon->status) == 1 ? 'selected' : '' }}>Active
                                </option>
                                <option value="0" {{ old('status', $favicon->status) == 0 ? 'selected' : '' }}>Deactive
                                </option>
                            </select>
                        </div> --}}
                        <div><label>Status</label></div>
                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio1" name="status" class="custom-control-input"
                                value="1" {{$favicon->status == 'Active' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="customRadio1">Active</label>
                        </div>

                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio2" name="status" class="custom-control-input"
                                value="0" {{ $favicon->status == 'Inactive' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio2">Inactive</label>
                        </div>
                        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                         <x-submit-button-component 
                      buttonStyle="$buttonStyle->buttonStyle"
                      content="Update Favicon"
                      />
                    </form>

                </div>
            </div>
            @endif
         </div>
    </div>
@endsection
