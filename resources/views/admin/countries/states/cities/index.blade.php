@extends('layouts.auth')
@section('title', ' Cities | Admin')
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
                            <li class="breadcrumb-item active" aria-current="page">City</li>
                        </ol>
                    </nav>
                    <span> <x-create-button-component createRoute="{{ url('admin/cities/create') }}"
                             deleteAllRoute="{{ url('admin/cities-destroy') }}"
                             activeRoute="{{ url('admin/cities-active') }}"
                             inActiveRoute="{{ url('admin/cities-inActive') }}"
                            countAll="{{ $countAll }}"
                            active="{{ $active }}"
                            inActive="{{ $inActive }}">
                        </x-create-button-component></span>
                </div>
            </div>

            <div class="card card-default">
                <div class="card-header">
                    {{-- @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @elseif (session('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('danger') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif --}}

                    @if (count($cities) > 0)
                        <table class="table table-striped" id="cities" class="display nowrap" width="100%">

                            <thead>
                                <tr>

                                    <th scope="col">#</th>
                                    <th scope="col"><input type="checkbox" id="selectAllCheckbox"></th>
                                    <th scope="col">Action</th>
                                    <th scope="col">City</th>
                                    <th scope="col">State</th>
                                    {{-- <th scope="col">Status</th> --}}
                                    
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $count = ($cities->currentPage() - 1) * $cities->perPage() + 1;
                                @endphp
                                @foreach ($cities as $city)
                                    <tr>

                                        <td>{{ $count }}</td>
                                        <td><input type="checkbox" class="selectCheckbox" name="selectedIds[]"
                                                value="{{ $city->id }}"></td>
                                                <td>
                                            <x-action-button destroyRoute="{{ route('cities.destroy', $city->id) }}"
                                                editRoute="{{ route('cities.edit', $city->id) }}" id="$city->id"
                                                entityType="'city'">
                                            </x-action-button>

                                        </td>
                                        <td>
                                           <x-status-component :status="$city->status" />{{ $city->city }}
                                        </td>
                                        <td>{{ $city->state->state ?? '' }} </td>
                                        {{-- <td>
                                            @if ($city->status === 'Active')
                                                <i class="mdi-record" style="color: green"></i>
                                            @elseif ($city->status === 'Inactive')
                                                <i class="mdi-record" style="color:red"></i>
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
                            <span>{{ $cities->links() }}</span>

                        </div>
                    @else()
                        <h3 class="text-center text-danger">No Cities found</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @section('scripts')
<script src="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#cities').DataTable();
        $(".dataTables_wrapper").css("width", "100%");
    });
    $(document).ready(function() {
        $('#countries').DataTable();
        $(".dataTables_wrapper").css("width", "100%");
    });

</script>

@endsection --}}
