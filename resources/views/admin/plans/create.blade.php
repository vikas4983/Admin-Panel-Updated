@extends('layouts.auth');
@section('title', 'Plan - Create | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item"> <a href="{{ route('plans.index') }}">Plan</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Add plan</li>
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
                    {{-- @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif --}}


                    <form action="{{ route('plans.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label> Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="form-group">
                            <label> Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Plan Name"
                                value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label> Duration</label>
                            <input type="text" class="form-control" name="duration" placeholder="Enter Plan Duration "
                                value="{{ old('duration') }}" required>
                        </div>
                        <div class="form-group">
                            <label> Price</label>
                            <input type="text" class="form-control" name="price" placeholder="Enter Plan Price"
                                value="{{ old('price') }}"required>
                        </div>
                        <div class="form-group">
                            <label>Offer</label>
                            <input type="text" class="form-control" name="offer" placeholder="Enter Offer Price"
                                value="{{ old('offer') }}"required>
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" class="form-control" name="allow_contact" placeholder="Enter Allow Contact"
                                value="{{ old('allow_contact') }}"required>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <select name="message" id="" class="form-control"required>
                               <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                      <div class="form-group">
                            <label>Chat</label>
                            <select name="chat" id="" class="form-control" required>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                      <div class="form-group">
                            <label>Video Call</label>
                            <select name="video_call" id="" class="form-control"required>
                               <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                      
                      {{-- <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="" class="form-control" value="{{ old('status') }}"required>
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
                      content="Create Plan"
                      />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
