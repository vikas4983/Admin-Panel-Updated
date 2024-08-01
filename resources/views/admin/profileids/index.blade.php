@extends('layouts.auth')
@section('title', 'ProfileIds | Admin')
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
                            <li class="breadcrumb-item active" aria-current="page">Profile Id</li>
                        </ol>
                    </nav>
                    <span> <x-create-button-component createRoute="{{ url('admin/profileids/create') }}"
                            activeRoute="{{ url('admin/profileids-active') }}"
                            deleteAllRoute="{{ url('admin/profileids-destroy') }}"
                            inActiveRoute="{{ url('admin/profileids-inActive') }}" countAll="{{ $countAll }}"
                            active="{{ $active }}" inActive="{{ $inActive }}">
                        </x-create-button-component></span>
                </div>
            </div>

            <div class="card card-default ">
                <div class="card-header">

                    @if (count($profileIds) > 0)
                        {{-- <table class="table " id="profileIds" class="display nowrap" width="100%"> --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    {{-- <th scope="col"><input type="checkbox" id="allCheckbox"></th> --}}
                                    <th scope="col">Action</th>
                                    <th scope="col">Profile Id Name</th>
                                    {{-- <th scope="col">Url</th> --}}

                                    {{-- <th scope="col">Status</th> --}}

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = ($profileIds->currentPage() - 1) * $profileIds->perPage() + 1;
                                @endphp
                                @foreach ($profileIds as $profileId)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        {{-- <td><input type="checkbox" class="selectCheckbox" name="selectedHeadersIds[]"
                                                    value="{{ $header->id }}"></td>
                                            <> --}}
                                        <td><x-action-button
                                                destroyRoute="{{ route('profileids.destroy', $profileId->id) }}"
                                                editRoute="{{ route('profileids.edit', $profileId->id) }}"
                                                id="$profileId->id" entityType="'profileids'">
                                            </x-action-button></td>
                                        {{-- <a href="{{ route('profileIds.show', $header->id) }}"><i class="fa fa-eye"
                                                        style="color:#04C7E0"></i></a> --}}

                                        <td><x-status-component :status="$profileId->status" />
                                            {{ $profileId->name }}</td>
                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <span>{{ $profileIds->links() }}</span>

                        </div>
                    @else()
                        <div class="text-center">
                            <h3 class="text-danger">No Profile Id found</h3>
                        </div>
                    @endif
                </div>

            </div>
        </div>
        <script></script>
    @endsection
