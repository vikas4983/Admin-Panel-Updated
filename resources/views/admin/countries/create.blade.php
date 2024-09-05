@extends('layouts.auth');
@section('title', 'Country | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <h3 class="card-header">
                    Create Countries </h3>
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item"> <a href="{{ route('countries.index') }}">Countries </a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Country</li>
                        </ol>
                    </nav>
                </div>
                <div class="card-body">
                    <form action="{{ route('countries.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Country</label>
                            <input type="name" class="form-control" name="country" placeholder="Enter Country Name"
                                required>
                        </div>
                        <div><label>Status</label></div>
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
                        <x-submit-button-component buttonStyle="$buttonStyle->buttonStyle" content="Create Country" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    @if (Session::has('success'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ session('success') }}");
    @endif
    @if (Session::has('delete'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('danger') }}");
    @endif
</script>
