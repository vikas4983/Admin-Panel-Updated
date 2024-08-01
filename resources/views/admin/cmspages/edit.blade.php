@extends('layouts.auth');
@section('title', 'CMS Page - Edit | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item"> <a href="{{ route('cmsPages.index') }}">CMS Page</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit CMS Page > {{ $cmsPage->name ?? ''}}</li>
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
                    
                    <form action="{{ route('cmsPages.update', $cmsPage->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label> Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name') ?? $cmsPage->name }}" placeholder="Enter CMS Page Name">
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title"
                                value="{{ old('title') ?? $cmsPage->title }}" placeholder="Enter CMS Page Title">
                        </div>
                        {{-- <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ old('status', $cmsPage->status) === 1 ? 'selected' : '' }}>Active
                                </option>
                                <option value="0" {{ old('status', $cmsPage->status) === 0 ? 'selected' : '' }}>Deactive
                                </option>
                            </select>
                        </div> --}}
                        <div><label>Status</label></div>
                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio1" name="status" class="custom-control-input"
                                value="1" {{$cmsPage->status == 'Active' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="customRadio1">Active</label>
                        </div>

                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio2" name="status" class="custom-control-input"
                                value="0" {{ $cmsPage->status == 'Inactive' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio2">Inactive</label>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <input type="text" class="form-control" name="content"
                                value="{{ old('content') ?? $cmsPage->content }}" placeholder="Enter CMS Page Content">
                        </div>
                        {{-- <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div> --}}
                        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                         <x-submit-button-component 
                      buttonStyle="$buttonStyle->buttonStyle"
                      content="Update CMS Page"
                      />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
