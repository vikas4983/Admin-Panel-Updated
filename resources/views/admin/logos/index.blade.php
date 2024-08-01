@extends('layouts.auth')
@section('title', 'Logo & Favicons | Admin')
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
                            <li class="breadcrumb-item active" aria-current="page">Logo</li>
                        </ol>
                    </nav>

                    <span> <x-create-button-component createRoute="{{ url('admin/logos/create') }}"
                            activeRoute="{{ url('admin/logos-active') }}" deleteAllRoute="{{ url('admin/logos-destroy') }}"
                            inActiveRoute="{{ url('admin/logos-inActive') }}" countAll="{{ $countAll }}"
                            active="{{ $active }}" inActive="{{ $inActive }}">
                        </x-create-button-component></span>
                </div>
            </div>

            <div class="card card-default">
                <div class="card-header">
                    @if (count($logos) > 0)
                        <table class="table table-striped" id="employees" class="display nowrap" width="100%">

                            <thead>
                                {{-- <tr>
                                    <th scope="col"># </th>
                                    <th scope="col"><input type="checkbox" id="selectAllCheckbox"></th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Logo</th>
 </tr> --}}
                            </thead>

                            <tbody>
                                @php
                                    $count = ($logos->currentPage() - 1) * $logos->perPage() + 1;
                                @endphp

                                {{-- Logo --}}
                                @foreach ($logos as $logo)
                                    <div class="card-deck col-lg-6">
                                        <div class="card">
                                            <div class="text-left mt-3 m-3">
                                                    <button type="button" class="btn  btn-outline-primary" data-toggle="modal"
                                                        data-target="#exampleModalForm">
                                                        <i class="mdi mdi-star-outline"></i> New Logo
                                                    </button>
                                                </div>
                                            


                                            <div class="modal fade" id="exampleModalForm" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalFormTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalFormTitle">Add New
                                                                Logo</h5>
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
                                                            <form action="{{ route('logos.store') }}"
                                                                id="bannerModalForm" method="post"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label> Upload Logo</label>
                                                                    <input type="file" class="form-control"
                                                                        name="logo" id="input">
                                                                        <p class="text-primary small mt-1"></i>Jpg, Jpeg, Png and Gif Files Supported, Max Size 1MB.</p>
                                                                    <div id="bannerNull" class="invalid-feedback"></div>
                                                                    <div id="bannerFill" class="valid-feedback"></div>
                                                                </div>
                                                                <div><label>Status</label></div>
                                                                <div
                                                                    class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                    <input type="radio" id="customRadio1" name="status"
                                                                        class="custom-control-input" value="1">
                                                                    <label class="custom-control-label"
                                                                        for="customRadio1">Active</label>
                                                                </div>
                                                                <div
                                                                    class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                    <input type="radio" id="customRadio2" name="status"
                                                                        class="custom-control-input" checked="checked"
                                                                        value="0">
                                                                    <label class="custom-control-label"
                                                                        for="customRadio2">InActive</label>
                                                                </div>
                                                                <x-submit-button-component
                                                                    buttonStyle="$buttonStyle->buttonStyle"
                                                                    content="Upload Banner" />
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center mt-3">
                                                <img width="500px" class="mt-3" height="100px"
                                                    src="{{ asset('storage/admin/logo-favicon/logos/' . ($logo ? $logo->name : '')) }}"
                                                    alt="Card image cap">
                                            </div>
                                            <br><br>
                                            <div class="card-body">
                                                {{-- <h5 class="card-title pt-2">Card title</h5> --}}
                                                <p class="card-text pb-3"><i class = "mdi mdi-alert-decagram"
                                                        style="color: #FEC400"></i> jpg
                                                    &
                                                    jpeg files supported.Max Size
                                                    1MB. </p>
                                                <p class="card-text pb-3"><i class = "mdi mdi-alert-decagram"
                                                        style="color: #FEC400"></i>Press
                                                    Control + f5 if logo not
                                                    reflecting after upload.. </p>
                                                <div class="d-flex justify-content-center mt-3">
                                                    <!-- Wrap all buttons in a div -->
                                                    {{-- <input type="checkbox" class="selectCheckbox mr-3"
                                                        name="selectedIds[]" value="{{ $logo->id ?? '' }}"
                                                        width="50px" height="50px"></td> --}}
                                                    {{-- <a href="{{ route('logos.create') }}"
                                                        class="mr-1 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle"><i class="fa fa-add"></i></a> --}}
                                                    <a href="{{ route('logos.edit', $logo->id ?? '') }}"
                                                        class="mr-1 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle"><i class="fa fa-edit"></i></a>
                                                    <form action="{{ route('logos.destroy', $logo->id ?? '') }}"
                                                        method="POST" class="mt-1">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="DeleteFunction();"
                                                            class="mr-1 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle"><i class="fa fa-trash"
                                                                style="color: red"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- Favicon --}}
                                @foreach ($favicons as $favicon)
                                    <div class="card-deck col-lg-6">
                                        <div class="card">
                                            <div class="text-left mt-3 m-3">
                                                    <button type="button" class="btn  btn-outline-primary" data-toggle="modal"
                                                        data-target="#exampleModalForm">
                                                        <i class="mdi mdi-star-outline"></i> New Facicon
                                                    </button>
                                                </div>
                                            


                                            <div class="modal fade" id="exampleModalForm" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalFormTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalFormTitle">Add New
                                                                Facicon</h5>
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
                                                            <form action="{{ route('favicons.store') }}"
                                                                id="bannerModalForm" method="post"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label> Upload Favicons</label>
                                                                    <input type="file" class="form-control"
                                                                        name="favicon" id="input">
                                                                        <p class="text-primary small mt-1"></i>Jpg, Jpeg, Png and Gif Files Supported, Max Size 1MB.</p>
                                                                    <div id="bannerNull" class="invalid-feedback"></div>
                                                                    <div id="bannerFill" class="valid-feedback"></div>
                                                                </div>
                                                                <div><label>Status</label></div>
                                                                <div
                                                                    class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                    <input type="radio" id="customRadio1" name="status"
                                                                        class="custom-control-input" value="1">
                                                                    <label class="custom-control-label"
                                                                        for="customRadio1">Active</label>
                                                                </div>
                                                                <div
                                                                    class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                    <input type="radio" id="customRadio2" name="status"
                                                                        class="custom-control-input" checked="checked"
                                                                        value="0">
                                                                    <label class="custom-control-label"
                                                                        for="customRadio2">InActive</label>
                                                                </div>
                                                                <x-submit-button-component
                                                                    buttonStyle="$buttonStyle->buttonStyle"
                                                                    content="Upload Banner" />
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center mt-3"><img class="mt-3" width="200px"
                                                    height="100px"
                                                    src="{{ asset('storage/admin/logo-favicon/favicons/' . ($favicon ? $favicon->name : '')) }}"
                                                    alt="Card image cap"></div>
                                            <br><br>
                                            <div class="card-body">
                                                {{-- <h5 class="card-title pt-2">Card title</h5> --}}
                                                <p class="card-text pb-3"><i class = "mdi mdi-alert-decagram"
                                                        style="color: #FEC400"></i> jpg
                                                    &
                                                    jpeg files supported.Max Size
                                                    1MB. </p>
                                                <p class="card-text pb-3"><i class = "mdi mdi-alert-decagram"
                                                        style="color: #FEC400"></i>Press
                                                    Control + f5 if favicon not
                                                    reflecting after upload.. </p>
                                                <div class="d-flex justify-content-center mt-3">
                                                    <!-- Wrap all buttons in a div -->
                                                    {{-- <input type="checkbox" class="selectCheckbox mr-3"
                                                        name="selectedIds[]" value="{{ $favicon->id ?? '' }}"
                                                        width="50px" height="50px"></td> --}}
                                                    {{-- <a href="{{ route('favicons.create') }}"
                                                        class="mr-1 btn btn-outline-primary"><i class="fa fa-add"></i></a> --}}
                                                    <a href="{{ route('favicons.edit', $favicon->id ?? '') }}"
                                                        class="mr-1 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle"><i class="fa fa-edit"></i></a>
                                                    <form action="{{ route('favicons.destroy', $favicon->id ?? '') }}"
                                                        method="POST" class="mt-1">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="DeleteFunction();"
                                                            class="mr-1 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle"><i class="fa fa-trash"
                                                                style="color: red"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="d-flex justify-content-center">
                            <span>{{ $logos->links() }}</span>
                        </div>
                    @else()
                        <h3 class="text-center text-danger">No Logo & Favicons Type found</h3>
                    @endif
                </div>
            </div>

        </div>
    </div>


@endsection
@section('scripts')

    <script>
        document.getElementById("selectAll").addEventListener("change", function() {
            var checkboxes = document.getElementsByClassName("checkbox");
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = this.checked;
                console.log(checkboxes[i]);
            }
        });

        var checkboxes = document.getElementsByClassName("checkbox");
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].addEventListener("change", function() {
                var allChecked = true;
                for (var j = 0; j < checkboxes.length; j++) {
                    console.log(checkboxes[j]);
                    if (!checkboxes[j].checked) {
                        allChecked = false;
                        break;

                    }
                }
                document.getElementById("selectAll").checked = allChecked;
            });
        }
    </script>


    {{-- <script src="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
     <script>
        $(document).ready(function() {
            $('#employees').DataTable();
            $(".dataTables_wrapper").css("width", "100%");
        });
     </script> --}}

@endsection
