@extends('layouts.auth')
@section('title', 'Banners | Admin')
@section('styles')
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
    <script src="http://datatables.net/release-datatables/media/js/jquery.js"></script>
    <script src="http://datatables.net/release-datatables/media/js/jquery.dataTables.js"></script>
    <script src="http://datatables.net/release-datatables/extensions/Scroller/js/dataTables.scroller.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}"
        rel="stylesheet" />
@endsection
@section('content')

    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Banner</li>
                        </ol>
                    </nav>

                    <span> <x-create-button-component createRoute="{{ url('admin/banners/create') }}"
                            activeRoute="{{ url('admin/banners-active') }}"
                            deleteAllRoute="{{ url('admin/banners-destroy') }}"
                            inActiveRoute="{{ url('admin/banners-inActive') }}" countAll="{{ $countAll }}"
                            active="{{ $active }}" inActive="{{ $inActive }}">
                        </x-create-button-component></span>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header">
                    @if (count($banners) > 0)
                        <table class="table table-striped" id="employees" class="display nowrap" width="100%">

                            <thead>
                            </thead>
                            <tbody>
                                <button type="button" class="mb-3 btn btn-lg btn-outline-primary" data-toggle="modal"
                                    data-target="#exampleModalForm"><i class="mdi mdi-star-outline"></i> New Banner
                                </button>

                                <div class="modal fade" id="exampleModalForm" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalFormTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalFormTitle">Add New Banner</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="modal-body">
                                                <form action="{{ route('banners.store') }}" id="bannerModalForm"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label> Upload Banner</label>
                                                        <input type="file" class="form-control" name="banner"
                                                            id="input">
                                                        <p class="text-primary small mt-1"></i>Jpg, Jpeg, Png and Gif Files
                                                            Supported, Max Size 1MB.</p>
                                                        <div id="bannerNull" class="invalid-feedback"></div>
                                                        <div id="bannerFill" class="valid-feedback"></div>
                                                    </div>
                                                    <div><label>Status</label></div>
                                                    <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                        <input type="radio" id="customRadio1" name="status"
                                                            class="custom-control-input" value="1">
                                                        <label class="custom-control-label"
                                                            for="customRadio1">Active</label>
                                                    </div>
                                                    <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                        <input type="radio" id="customRadio2" name="status"
                                                            class="custom-control-input" checked="checked" value="0">
                                                        <label class="custom-control-label"
                                                            for="customRadio2">InActive</label>
                                                    </div>
                                                    <x-submit-button-component buttonStyle="$buttonStyle->buttonStyle"
                                                        content="Upload Banner" />
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($banners as $banner)
                <div class="col-md-4 mb-3">
                    <div class="card">

                        @if ($banner->status == 'Active' ?? '')
                            <div class="card-img-top"
                                style="border-top-left-radius: 2px; border-top-right-radius: 2px; background-color: #0ACB8E; height: 5px;">
                            </div>
                        @else
                            <div class="card-img-top"
                                style="border-top-left-radius: 2px; border-top-right-radius: 2px; background-color: #ec0c0c; height: 5px;">
                            </div>
                        @endif

                        <img class="card-img-top"
                            src="{{ asset('storage/admin/banners/' . ($banner ? $banner->name : '')) }}"
                            alt="Banner Image">
                        <div class="card-body text-center"> <!-- Apply text-center class here -->
                            {{-- <h5 class="card-title">Card Title</h5> --}}
                            <p class="card-text pb-3"><i class = "mdi mdi-alert-decagram" style="color: #FEC400"></i> jpg
                                &
                                jpeg files supported.Max Size
                                1MB. </p>
                            <p class="card-text pb-3"><i class = "mdi mdi-alert-decagram"
                                    style="color: #FEC400"></i>Press
                                Control + f5 if banner not
                                reflecting after upload.. </p>
                            <div class="d-flex justify-content-center">
                                <x-edit-action-button-component :editRoute="route('banners.edit', $banner->id)" :id="$banner->id" />
                                <x-destroy-action-button-component :destroyRoute="route('banners.destroy', $banner->id)" :id="$banner->id" />
                       
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </tbody>

        </table>
        <div class="d-flex justify-content-center">
            <span>{{ $banners->links() }}</span>
        </div>
    @else()
        <h3 class="text-center text-danger">No Banner found</h3>
        @endif
    </div>
    </div>

    </div>
    </div>


@endsection
@section('scripts')

@endsection
