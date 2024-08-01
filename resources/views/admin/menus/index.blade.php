@extends('layouts.auth')
@section('title', 'Menus | Admin')
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
                            <li class="breadcrumb-item active" aria-current="page">Menu</li>
                        </ol>
                    </nav>
                    <span> <x-create-button-component createRoute="{{ url('admin/menus/create') }}"
                            activeRoute="{{ url('admin/menus-active') }}" deleteAllRoute="{{ url('admin/menus-destroy') }}"
                            inActiveRoute="{{ url('admin/menus-inActive') }}" countAll="{{ $countAll }}"
                            active="{{ $active }}" inActive="{{ $inActive }}">
                        </x-create-button-component></span>
                </div>
            </div>
            <div class="row">
                <div class="card card-default col-lg-6">
                    <div class="card-header">
                        <div class="text-center col-lg-12">
                            <h6 class="btn btn-primary btn-sm mb-3">Header Menu</h6>
                        </div>
                        @if (count($headers) > 0)
                            {{-- <table class="table " id="menus" class="display nowrap" width="100%"> --}}
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"><input type="checkbox" id="allCheckbox"></th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Menu Name</th>
                                        {{-- <th scope="col">Url</th> --}}

                                        {{-- <th scope="col">Status</th> --}}

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = ($headers->currentPage() - 1) * $headers->perPage() + 1;
                                    @endphp
                                    
                                    @foreach ($headers as $header)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td><input type="checkbox" class="selectCheckbox" name="selectedHeadersIds[]"
                                                    value="{{ $header->id }}"></td>
                                            <td>
                                                <x-action-button destroyRoute="{{ route('menus.destroy', $header->id) }}"
                                                    editRoute="{{ route('menus.edit', $header->id) }}" id="$header->id"
                                                    entityType="'headers'">
                                                </x-action-button>
                                                <a href="{{ route('menus.show', $header->id) }}" class="mr-1 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle"><i class="fa fa-eye"
                                                        style="color:#04C7E0"></i></a>
                                            </td>
                                            {{-- <td>{{ $image }}</td> --}}
                                            {{-- <td> @if ($menu->status === 'Active')
                                              <i class="mdi mdi-record" style="color: green"></i>
                                            @elseif ($menu->status === 'Inactive')
                                               <i class="mdi mdi-record" style="color:red"></i>
                                            @endif --}}
                                            <td><x-status-component :status="$header->status" />
                                                {{ $header->name }}</td>
                                            {{-- <td>
                                                {{ $menu->url }}</td> --}}

                                            {{-- <td>
                                            @if ($menu->status === 'Active')
                                              <i class="mdi mdi-record" style="color: green"></i>
                                            @elseif ($menu->status === 'Inactive')
                                               <i class="mdi mdi-record" style="color:red"></i>
                                            @endif
                                        </td> --}}

                                        </tr>
                                        @php
                                            $count++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                <span>{{ $headers->links() }}</span>

                            </div>
                        @else()
                            <h3 class="text-center text-danger">No Header found</h3>
                        @endif
                    </div>
                </div>
                {{-- comment --}}
                <div class="card card-default col-lg-6">
                    <div class="card-header">
                        <div class="text-center col-lg-12">
                            <h6 class="btn btn-primary btn-sm mb-3">Footer Menu</h6>
                        </div>
                        @if (count($footers) > 0)
                            {{-- <table class="table " id="menus" class="display nowrap" width="100%"> --}}
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        {{-- <th scope="col"><input type="checkbox" id="selectAllCheckbox"></th> --}}
                                        <th scope="col">Action</th>
                                        <th scope="col">Menu Name</th>
                                        {{-- <th scope="col">Url</th> --}}

                                        {{-- <th scope="col">Status</th> --}}

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = ($footers->currentPage() - 1) * $footers->perPage() + 1;
                                    @endphp
                                    @foreach ($footers as $footer)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            {{-- <td><input type="checkbox" class="selectCheckbox" name="selectedIds[]"
                                                    value="{{ $footer->id }}"></td> --}}
                                            <td>
                                                <x-action-button destroyRoute="{{ route('menus.destroy', $footer->id) }}"
                                                    editRoute="{{ route('menus.edit', $footer->id) }}" id="$footer->id"
                                                    entityType="'footers'">
                                                </x-action-button>
                                                <a href="{{ route('menus.show', $footer->id) }}" class="mr-1 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle"><i class="fa fa-eye "
                                                        style="color:#04C7E0"></i></a>
                                            </td>
                                            {{-- <td>{{ $image }}</td> --}}
                                            {{-- <td> @if ($menu->status === 'Active')
                                              <i class="mdi mdi-record" style="color: green"></i>
                                            @elseif ($menu->status === 'Inactive')
                                               <i class="mdi mdi-record" style="color:red"></i>
                                            @endif --}}
                                            <td><x-status-component :status="$footer->status" />
                                                {{ $footer->name }}</td>
                                            {{-- <td>
                                                {{ $menu->url }}</td> --}}

                                            {{-- <td>
                                            @if ($menu->status === 'Active')
                                              <i class="mdi mdi-record" style="color: green"></i>
                                            @elseif ($menu->status === 'Inactive')
                                               <i class="mdi mdi-record" style="color:red"></i>
                                            @endif
                                        </td> --}}

                                        </tr>
                                        @php
                                            $count++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                <span>{{ $footers->links() }}</span>

                            </div>
                        @else()
                            <h3 class="text-center text-danger">No Footer found</h3>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script></script>
@endsection
