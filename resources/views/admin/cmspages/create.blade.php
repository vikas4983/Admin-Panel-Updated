@extends('layouts.auth');
@section('title', 'CMS Page - Create | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                              <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item"> <a href="{{ route('cmsPages.index') }}">CMS Page</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Add CMS Page</li>

                        </ol>
                    </nav>
                    {{-- <span> <x-create-button-component createRoute="{{ url('admin/cmsPages/create') }}"
                        >
                        </x-create-button-component></span> --}}
            
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


                    <form action="{{ route('cmsPages.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label> Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter CMS Page Name">
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter CMS Page Title">
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

                        <div id="toolbar">
                <span class="ql-formats">
                    <select class="ql-font"></select>
                    <select class="ql-size"></select>
                </span>
                <span class="ql-formats">
                    <button class="ql-bold"></button>
                    <button class="ql-italic"></button>
                    <button class="ql-underline"></button>
                </span>
                <span class="ql-formats">
                    <select class="ql-color"></select>
                </span>
                <span class="ql-formats">
                    <button class="ql-blockquote"></button>
                </span>
                <span class="ql-formats">
                    <button class="ql-list" value="ordered"></button>
                    <button class="ql-list" value="bullet"></button>
                    <button class="ql-indent" value="-1"></button>
                    <button class="ql-indent" value="+1"></button>
                </span>
                <span class="ql-formats">
                    <button class="ql-direction" value="rtl"></button>
                    <select class="ql-align"></select>
                </span>
            </div>
            <div id="editor"></div>
            <input type="hidden" name="content" id="content">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <div class="text-center">
                            {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                             {{-- <x-submit-button-component 
                      buttonStyle="$buttonStyle->buttonStyle"
                      content="Create CMS Page"
                       /> --}}
                    </form>

                </div>
            </div>
        </div>
    </div>
      <script>
    var quill = new Quill('#editor', {
        theme: 'snow'
    });

    document.querySelector('form').onsubmit = function() {
        var content = document.querySelector('input[name=content]');
        content.value = quill.root.innerHTML;
    };
</script>

    
@endsection
