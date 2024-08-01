@extends('layouts.auth');
@section('title', 'Success Story - Create | Admin')
@section('content')
    <div class="content-wrapper">
       <div class="container ">
    <div class="row col-lg-12">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item"> <a href="{{ route('successStories.index') }}">Success
                                    Stories</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Success Story</li>
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
                    <form action="{{ route('successStories.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                            <div class="form-group col-lg-6">
                                <label for="Groom Name">Groom Name</label>
                                <input type="text" class="form-control" id="groom_name" name="groom_name" placeholder="Enter Groom Name"
                                    value="{{ old('groom_name') }}" required>
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label for="Bride Name">Bride Name</label>
                                <input type="text" class="form-control" id="bride_name" name="bride_name" placeholder="Enter Bride Name"
                                    value="{{ old('bride_name') }}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="Date">Wedding Date</label>
                                <input type="date" class="form-control" id="wedding_date" name="wedding_date" 
                                    value="{{ old('wedding_date') }}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="Wedding image">Image</label>
                                <input type="file" class="form-control-file" id="wedding_image" name="wedding_image"
                                value="{{old('wedding_image')}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="Description">Description</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="Enter Wedding Description"
                                    value="{{ old('description') }}" required>
                            </div>
                            <div><label class="mr-3">Status</label></div>
                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">

                                <input type="radio" id="customRadio1" name="status" class="custom-control-input"
                                    value="1">
                                <label class="custom-control-label" for="customRadio1">Active</label>
                            </div>

                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                <input type="radio" id="customRadio2" name="status" class="custom-control-input"
                                    checked="checked" value="0">
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
</div>

    </div>
    <script>
        function createSuccessStory(){
            alert('If you click on submit Button then Your account will be restricted from further use!');

        }
    </script>
@endsection
