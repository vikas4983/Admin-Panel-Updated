@extends('layouts.auth');
@section('title', 'Plan - Edit | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                              <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item"> <a href="{{ route('plans.index') }}">Plan</a> </li>
                           <li class="breadcrumb-item active" aria-current="page">Edit Income > {{$plan->name }}</li>
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


                <form action="{{ route('plans.update', $plan->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" 
                            name="image" >
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" value="{{ old('name') ?? $plan->name }}"
                            name="name" placeholder="Enter Plan Name">
                    </div>
                    <div class="form-group">
                        <label>Duration</label>
                        <input type="text" class="form-control" value="{{ old('duration') ?? $plan->duration }}"
                            name="duration" placeholder="Enter Plan Duration">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" value="{{ old('price') ?? $plan->price }}"
                            name="price" placeholder="Enter Plan Price">
                    </div>
                    <div class="form-group">
                        <label>Offer</label>
                        <input type="text" class="form-control" value="{{ old('offer') ?? $plan->offer }}"
                            name="offer" placeholder="Enter Plan Offer">
                    </div>
                    
                    <div class="form-group">
                        <label>Contact</label>
                        <input type="allow_contact" class="form-control" value="{{ old('allow_contact') ?? $plan->allow_contact}}"
                            name="allow_contact" placeholder="Enter Allow Contact">
                    </div>
                    
                    <div class="form-group">
                        <label>Message</label>
                        <select name="message" id="" class="form-control">
                            <option value="Yes" {{ old('message', $plan->message) == 'Yes' ? 'selected' : '' }}>Yes
                            </option>
                            <option value="No" {{ old('message', $plan->message) == 'No' ? 'selected' : '' }}>No
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Chat</label>
                        <select name="chat" id="" class="form-control">
                            <option value="Yes" {{ old('chat', $plan->chat) == 'Yes' ? 'selected' : '' }}>Yes
                            </option>
                            <option value="No" {{ old('chat', $plan->chat) == 'No' ? 'selected' : '' }}>No
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Video Call</label>
                        <select name="video_call" id="" class="form-control">
                            <option value="Yes" {{ old('video_call', $plan->video_call) == 'Yes' ? 'selected' : '' }}>Yes
                            </option>
                            <option value="No" {{ old('video_call', $plan->video_call) == 'No' ? 'selected' : '' }}>No
                            </option>
                        </select>
                    </div>
                    
                    {{-- <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="1" {{ old('status', $plan->status) == 1 ? 'selected' : '' }}>Active
                            </option>
                            <option value="0" {{ old('status', $plan->status) == 0 ? 'selected' : '' }}>Deactive
                            </option>
                        </select>
                    </div> --}}
                    <div><label>Status</label></div>
                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio1" name="status" class="custom-control-input"
                                value="1" {{$plan->status == 'Active' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="customRadio1">Active</label>
                        </div>

                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio2" name="status" class="custom-control-input"
                                value="0" {{ $plan->status == 'Inactive' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio2">Inactive</label>
                        </div>
                    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                    <x-submit-button-component 
                      buttonStyle="$buttonStyle->buttonStyle"
                      content="Update Plan"
                      />
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
