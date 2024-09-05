@extends('layouts.auth')
@section('title', 'Employees | Admin')
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
                            <li class="breadcrumb-item active" aria-current="page">Employee</li>
                        </ol>
                    </nav>
                     <span> <x-create-button-component createRoute="{{ url('admin/employees/create') }}"
                            activeRoute="{{ url('admin/employees-active') }}" deleteAllRoute="{{ url('admin/employees-destroy') }}"
                            inActiveRoute="{{ url('admin/employees-inActive') }}" countAll="{{ $countAll }}"
                            active="{{ $active }}" inActive="{{ $inActive }}">
                        </x-create-button-component></span>
                </div>
            </div>

            <div class="card card-default">
                <div class="card-header">
                   @if (count($employees) > 0)
                        <table class="table table-striped" id="employees" class="display nowrap" width="100%">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"><input type="checkbox" id="selectAllCheckbox"></th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Employee Type</th>
                                   
                                    
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $count = ($employees->currentPage() - 1) * $employees->perPage() + 1;
                                @endphp
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td><input type="checkbox" class="selectCheckbox" name="selectedIds[]"
                                                value="{{ $employee->id }}"></td>
                                        <td>
                                            <div class="d-flex flex-row">
                                                <x-edit-action-button-component :editRoute="route('employees.edit', $employee->id)" :id="$employee->id" />
                                                <x-destroy-action-button-component :destroyRoute="route('employees.destroy', $employee->id)" :id="$employee->id" />
                                            </div>

                                        </td>
                                        <td>
                                           <x-status-component :status="$employee->status" />{{ $employee->employee }}
                                        </td>
                                   </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach

                            </tbody>

                        </table>
                        <div class="d-flex justify-content-center">
                            <span>{{ $employees->links() }}</span>
                        </div>
                    @else()
                        <h3 class="text-center text-danger">No Employees Type found</h3>
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
            $('#employees').DataTable();
            $(".dataTables_wrapper").css("width", "100%");
        });
    </script>

@endsection --}}
