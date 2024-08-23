@extends('layouts.auth');
@section('title', 'Email Template - Edit | Admin')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                          <li class="breadcrumb-item"> <a href="{{ route('emailTemplates.index') }}">Email Templates</a> </li>
                           <li class="breadcrumb-item active" aria-current="page">Edit Education > {{ $emailTemplate->name }} </li>
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

                <form action="{{ route('emailTemplates.update', $emailTemplate->id) }}" method="post">
                       @csrf
                       @method('patch')
                    <div class="row">
                      <div class="form-group col-lg-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Email Template Name" value="{{ old('name', $emailTemplate->name ?? '') }}" required>
                
                      </div>
                      <div class="form-group col-lg-3">
                        <label>Subject</label>
                        <input type="text" class="form-control" name="subject" placeholder="Enter Subject" value="{{ old('subject',$emailTemplate->subject ?? '')   }}" required>
                      </div>
                      <div class="form-group col-lg-3">
                        <label>Action</label>
                        <select name="action" class="form-control">
                          <option value="1" {{ old('action', $emailTemplate->action) == 'Admin' ? 'selected' : '' }}>Admin</option>
                          <option value="0" {{ old('action', $emailTemplate->action) == 'User' ? 'selected' : '' }}>User</option>
                        </select>
                      </div>
                      
                      <div class="form-group col-lg-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                          <option value="1" {{ old('status',$emailTemplate->status) == 'Active' ? 'selected' : '' }}>Active</option>
                          <option value="0" {{ old('status',$emailTemplate->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                      </div>
                      <div class="form-group col-lg-12">
                        <label>Body</label>
                        <textarea class="form-control" name="body" placeholder="Enter Body" required>{{ old('body', $emailTemplate->body ?? '') }}</textarea>
                      </div>
                      
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection



































