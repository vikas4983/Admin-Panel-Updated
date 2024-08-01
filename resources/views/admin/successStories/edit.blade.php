@extends('layouts.auth');
@section('title', 'Success Story - Edit | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item"> <a href="{{ route('successStories.index') }}">Plan</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Success Story >
                                {{ $successStory->groom_name }} & {{ $successStory->bride_name }}</li>
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
 
                    <form action="{{ route('successStories.update', $successStory->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="Groom Name">Groom Name</label>
                                <input type="text" class="form-control" id="groom_name" name="groom_name"
                                    placeholder="Enter Groom Name"
                                    value="{{ old('groom_name', $successStory->groom_name) }}">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="Bride Name">Bride Name</label>
                                <input type="text" class="form-control" id="bride_name" name="bride_name"
                                    placeholder="Enter Bride Name"
                                    value="{{ old('bride_name', $successStory->bride_name) }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="Date">Wedding Date</label>
                                <input type="date" class="form-control" id="wedding_date" name="wedding_date"
                                    value="{{ old('wedding_date', $successStory->wedding_date) }}">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Enter Wedding Description">{{ old('description', $successStory->description) }}</textarea>
                            </div>

                            <div class="form-group col-lg-6">
                                <input type="file" class="form-control-file" id="wedding_image" name="wedding_image">
                                <img src="{{ asset('storage/admin/successStory/' . $successStory->wedding_image ?? '') }}"
                                    width="300px" height="150px">
                            </div>
                           <div>
    <label class="mr-3">Status</label>
</div>
<div class="custom-control custom-radio d-inline-block mr-3 mb-3">
    <input type="radio" id="customRadio1" name="status" class="custom-control-input"
        value="1" {{ old('status', $successStory->status) == 'Active' ? 'checked' : '' }}>
    <label class="custom-control-label" for="customRadio1">Active</label>
</div>

<div class="custom-control custom-radio d-inline-block mr-3 mb-3">
    <input type="radio" id="customRadio2" name="status" class="custom-control-input"
        value="0" {{ old('status', $successStory->status) == 'Inactive' ? 'checked' : '' }}>
    <label class="custom-control-label" for="customRadio2">InActive</label>
</div>

                        </div>
                        <div class="text-center">
                            <button type="submit" onclick="createSuccessStory();" class="btn btn-primary">Submit</button>
                        </div>
                        {{-- <x-submit-button-component buttonStyle="$buttonStyle->buttonStyle" content="Create Plan" /> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
