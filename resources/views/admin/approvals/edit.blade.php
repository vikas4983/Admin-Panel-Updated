@extends('layouts.auth');
@section('title', 'Approvals - Edit | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item"> <a href="{{ route('approvals.index') }}">Approval</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Approvals >
                                {{ $approval->user->name }}</li>
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
                    <form action="{{ route('approvals.update', $approval->id ?? '') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label>About Me</label>
                                <select name="about_me" class="form-control" required>
                                    <option value="0"
                                        {{ old('about_me', $approval->about_me ?? '') == 'Hide From All User' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="1"
                                        {{ old('about_me', $approval->about_me ?? '') == 'All User Can View' ? 'selected' : '' }}>
                                        Approved</option>
                                </select>
                                <div>
                                    <textarea class="col-lg-12 mb-3"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>About Education</label>
                                <select name="about_education" class="form-control" required>
                                    <option value="0"
                                        {{ old('about_education', $approval->about_education ?? '') == 'Hide From All User' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="1"
                                        {{ old('about_education', $approval->about_education ?? '') == 'All User Can View' ? 'selected' : '' }}>
                                        Approved</option>
                                </select>
                                 <div>
                                    <textarea class="col-lg-12 mb-3"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>About Occupation</label>
                                <select name="about_occupation" class="form-control" required>
                                    <option value="0"
                                        {{ old('about_occupation', $approval->about_occupation ?? '') == 'Hide From All User' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="1"
                                        {{ old('about_occupation', $approval->about_occupation ?? '') == 'All User Can View' ? 'selected' : '' }}>
                                        Approved</option>
                                </select>
                                 <div>
                                    <textarea class="col-lg-12 mb-3"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>About Family</label>
                                <select name="about_family" class="form-control" required>
                                    <option value="0"
                                        {{ old('about_family', $approval->about_family ?? '') == 'Hide From All User' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="1"
                                        {{ old('about_family', $approval->about_family ?? '') == 'All User Can View' ? 'selected' : '' }}>
                                        Approved</option>
                                </select>
                                 <div>
                                    <textarea class="col-lg-12 mb-3"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Read Carefully</label>
                                <select name="read_carefully" class="form-control" required>
                                    <option value="0"
                                        {{ old('read_carefully', $approval->read_carefully ?? '') == 'Hide From All User' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="1"
                                        {{ old('read_carefully', $approval->read_carefully ?? '') == 'All User Can View' ? 'selected' : '' }}>
                                        Approved</option>
                                </select>
                                 <div>
                                    <textarea class="col-lg-12 mb-3"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Success Story</label>
                                <select name="success_story" class="form-control" required>
                                    <option value="0"
                                        {{ old('success_story', $approval->success_story ?? '') == 'Hide From All User' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="1"
                                        {{ old('success_story', $approval->success_story ?? '') == 'All User Can View' ? 'selected' : '' }}>
                                        Approved</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Image-1</label>
                                <select name="image1" class="form-control" required>
                                    <option value="0"
                                        {{ old('image1', $approval->image1 ?? '') == 'Hide From All User' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="1"
                                        {{ old('image1', $approval->image1 ?? '') == 'All User Can View' ? 'selected' : '' }}>
                                        Approved</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Image-2</label>
                                <select name="image2" class="form-control" required>
                                    <option value="0"
                                        {{ old('image2', $approval->image2 ?? '') == 'Hide From All User' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="1"
                                        {{ old('image2', $approval->image2 ?? '') == 'All User Can View' ? 'selected' : '' }}>
                                        Approved</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Image-3</label>
                                <select name="image3" class="form-control" required>
                                    <option value="0"
                                        {{ old('image3', $approval->image3 ?? '') == 'Hide From All User' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="1"
                                        {{ old('image3', $approval->image3 ?? '') == 'All User Can View' ? 'selected' : '' }}>
                                        Approved</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Image-14</label>
                                <select name="image1" class="form-control" required>
                                    <option value="0"
                                        {{ old('image14', $approval->image14 ?? '') == 'Hide From All User' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="1"
                                        {{ old('image14', $approval->image14 ?? '') == 'All User Can View' ? 'selected' : '' }}>
                                        Approved</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Image-5</label>
                                <select name="image1" class="form-control" required>
                                    <option value="0"
                                        {{ old('image5', $approval->image5 ?? '') == 'Hide From All User' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="1"
                                        {{ old('image5', $approval->image5 ?? '') == 'All User Can View' ? 'selected' : '' }}>
                                        Approved</option>
                                </select>
                            </div>

                           
                            <div class="form-group col-lg-3">
                                <label>Image-6</label>
                                <select name="image1" class="form-control" required>
                                    <option value="0"
                                        {{ old('image6', $approval->image6 ?? '') == 'Hide From All User' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="1"
                                        {{ old('image6', $approval->image6 ?? '') == 'All User Can View' ? 'selected' : '' }}>
                                        Approved</option>
                                </select>
                            </div>


                            {{-- <div class="form-group col-lg-3">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="1" {{ old('status',$approval->status ?? '') == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status',$approval->status ?? '') == 'Inactive' ? 'selected' : '' }}>Deactive</option>
                                </select>
                            </div> --}}
                            <div><label class="mr-3">Status</label></div>
                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                <input type="radio" id="customRadio1" name="status" class="custom-control-input"
                                    value="1" {{ $approval->status == 'Active' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customRadio1">Active</label>
                            </div>

                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                <input type="radio" id="customRadio2" name="status" class="custom-control-input"
                                    value="0" {{ $approval->status == 'Inactive' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customRadio2">Inactive</label>
                            </div>


                        </div>
                        <div class="text-center">
                            {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                {{-- <x-submit-button-component buttonStyle="$buttonStyle->buttonStyle"
                                    content="Update Approral" /> --}}
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
