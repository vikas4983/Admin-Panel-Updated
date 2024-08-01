@extends('layouts.auth')
@section('title', 'Site Settings | Admin')
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
                {{-- <h3 class="card-header">
                Incomes</h3> --}}
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Site Setting</li>
                        </ol>
                    </nav>
                    {{-- <span> <x-create-button-component createRoute="{{ url('admin/menus/create') }}"
                            activeRoute="{{ url('admin/menus-active') }}" deleteAllRoute="{{ url('admin/menus-destroy') }}"
                            inActiveRoute="{{ url('admin/menus-inActive') }}" countAll="{{ $countAll }}"
                            active="{{ $active }}" inActive="{{ $inActive }}">
                        </x-create-button-component></span> --}}
                </div>
            </div>

            <div class="card card-default">
                <div class="card-header">
                    @if (count($siteSettings) > 0)
                        {{-- <table class="table " id="menus" class="display nowrap" width="100%"> --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    {{-- <th scope="col"><input type="checkbox" id="allCheckbox"></th> --}}
                                    <th scope="col">Action</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    {{-- <th scope="col">Number</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">GAC</th>
                                    <th scope="col">Footer</th> --}}


                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = ($siteSettings->currentPage() - 1) * $siteSettings->perPage() + 1;
                                @endphp
                                @foreach ($siteSettings as $siteSetting)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        {{-- <td><input type="checkbox" class="selectCheckbox" name="selectedHeadersIds[]"
                                                    value="{{ $header->id }}"></td> --}}
                                        <td class="action-buttons">
                                            <x-action-button
                                                destroyRoute="{{ route('siteSettings.destroy', $siteSetting->id) }}"
                                                editRoute="{{ route('siteSettings.edit', $siteSetting->id) }}"
                                                id="$siteSetting->id" entityType="'siteSettings'"
                                               >
                                            </x-action-button>

                                           

                                            {{-- <a href="{{ route('siteSettings.show', $siteSetting->id) }}"><i class="fa fa-eye"
                                                        style="color:#04C7E0"></i></a> --}}
                                            <button data-toggle="modal" data-target="#exampleModalForm"
                                                class="mr-1 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle">
                                                <i class="fa fa-eye" style="color:#04C7E0"></i>
                                            </button>

                                            <div class="modal fade" id="exampleModalForm" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalFormTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalFormTitle"><b>Site
                                                                    Setting</b>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-12  mb-3">
                                                                        <div class="card text-white bg-primary mt-3">
                                                                            <h6 style="color:yellow"> Name</h6>
                                                                            <p class="card-text">{{ $siteSetting->name }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="card text-white bg-primary mt-3">
                                                                            <h6 style="color:yellow"> Title</h6>
                                                                            <p class="card-text">{{ $siteSetting->title }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="card text-white bg-primary mt-3">
                                                                            <h6 style="color:yellow"> Description</h6>
                                                                            <p class="card-text">
                                                                                {{ $siteSetting->description }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="card text-white bg-primary mt-3">
                                                                            <h6 style="color:yellow"> Number</h6>
                                                                            <p class="card-text">{{ $siteSetting->number }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="card text-white bg-primary mt-3">
                                                                            <h6 style="color:yellow"> Email</h6>
                                                                            <p class="card-text">{{ $siteSetting->email }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="card text-white bg-primary mt-3">
                                                                            <h6 style="color:yellow"> Google Analytics Code
                                                                            </h6>
                                                                            <p class="card-text">
                                                                                {{ $siteSetting->google_analytics_code }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="card text-white bg-primary mt-3">
                                                                            <h6 style="color:yellow"> Footer </h6>
                                                                            <p class="card-text">{{ $siteSetting->footer }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <style>
                                                    .custom-modal-dialog {
                                                        max-width: 1000px;
                                                        /* Set your custom width */
                                                        height: 1000px;
                                                        /* Set your custom height */
                                                    }
                                                </style>
                                        </td>
                                        <td><x-status-component :status="$siteSetting->status" />
                                            {{ $siteSetting->name }}</td>
                                        <td>{{ Str::limit($siteSetting->title, 15) }}</td>
                                        <td>{{ Str::limit($siteSetting->description, 15) }}</td>
                                        {{-- <td>{{ Str::limit($siteSetting->number, 13) }}</td>
                                        <td>{{ Str::limit($siteSetting->email, 50) }}</td>
                                        <td>{{ Str::limit($siteSetting->google_analytics_code, 50) }}</td>
                                        <td>{{ Str::limit($siteSetting->footer, 15) }}</td> --}}
                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <span>{{ $siteSettings->links() }}</span>

                        </div>
                    @else()
                        <h3 class="text-center text-danger">No Site Setting found</h3>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <script></script>
@endsection
