@extends('layouts.auth')
@section('title', 'CMS Pages | Admin')
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
                            <li class="breadcrumb-item active" aria-current="page">CMS Page</li>

                        </ol>
                    </nav>
                    {{-- <button type="button" class="btn btn-primary btn-lg">
                        CMS Pages <span class="badge bg-secondary">{{ $active }}</span>
                    </button> --}}

                    @foreach ($cmspages as $cmspage)
                    @endforeach

                    <span> <x-create-button-component createRoute="{{ url('admin/cmsPages/create') }}"
                            deleteAllRoute="{{ url('admin/cms-destroy') }}"
                            activeRoute="{{ url('admin/cms-active') }}"
                            inActiveRoute="{{ url('admin/cms-inActive') }}" countAll="{{ $countAll }}"
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



                    @if (count($cmspages) > 0)
                        <table class="table table-striped" id="employees" class="display nowrap" width="100%">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"><input type="checkbox" id="selectAllCheckbox"></th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = ($cmspages->currentPage() - 1) * $cmspages->perPage() + 1;
                                @endphp
                                @foreach ($cmspages as $cmspage)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td><input type="checkbox" class="selectCheckbox" name="selectedIds[]"
                                                value="{{ $cmspage->id }}"></td>

                                        <td>
                                            <x-action-button
                                                destroyRoute="{{ route('cmsPages.destroy', $cmspage->id ?? '') }}"
                                                editRoute="{{ route('cmsPages.edit', $cmspage->id ?? '') }}" id="$logo->id"
                                                entityType="'logos'">
                                            </x-action-button>
                                            <a href="{{ route('cmsPages.show',$cmspage->slug)}}"
                                            ><i class="fa fa-eye" style="color:#04C7E0"></i> </a>
                                        </td>
                                        <td><x-status-component :status="$cmspage->status" />{{ $cmspage->name }}</td>
                                        <td>{{ $cmspage->slug }}</td>
                                        <td>{{ $cmspage->title }}</td>
                                        <td>{{ Str::limit($cmspage->content, 20) }}</td>

                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <span>{{ $cmspages->links() }}</span>
                        </div>
                    @else()
                        <h3 class="text-center text-danger">No CMS Pages found</h3>
                    @endif
                </div>
            </div>

        </div>
    </div>


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all checkboxes with class 'selectCheckbox'
            var checkboxes = document.querySelectorAll('.selectCheckbox');
            var selectAllCheckbox = document.getElementById('selectAllCheckbox');
            var deleteBtn = document.getElementById('deleteBtn');
            var activeBtn = document.getElementById('activeBtn');
            var inActiveBtn = document.getElementById('inActiveBtn');

            // Function to get selected checkbox IDs
            function getSelectedIds() {
                var selectedIds = [];

                // Loop through each checkbox to get the selected IDs
                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        selectedIds.push(checkbox.value);
                    }
                });

                return selectedIds;
            }

            // Event listener for select all checkbox
            selectAllCheckbox.addEventListener('change', function() {
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            // Function to handle delete operation
            function deleteSelectedItems() {
                var selectedIds = getSelectedIds();
                console.log(selectedIds);


                // Set the selected IDs to the hidden input field
                document.getElementById('deleteSelectedIds').value = selectedIds.join(',');
                //debugger;
                // Submit the form
                document.getElementById('deleteForm').submit();
            }

            // Event listener for delete button click
            deleteBtn.addEventListener('click', function() {
                var confirmDelete = confirm("Are you sure you want to delete the selected items?");
                if (confirmDelete) {
                    deleteSelectedItems();
                }
            });

            // For Active
            function activeSelectedItems() {
                var selectedIds = getSelectedIds();
                console.log(selectedIds);

                // Set the selected IDs to the hidden input field
                document.getElementById('activeSelectedIds').value = selectedIds.join(',');

                // Submit the form
                document.getElementById('activeBtnForm').submit();
            }

            activeBtn.addEventListener("click", function() {
                var confirmActive = confirm("Are you sure you want to Active the selected items?");
                if (confirmActive) {
                    activeSelectedItems();
                }
            });

            // For InActive
            function inActiveSelectedItems() {
                var selectedIds = getSelectedIds();
                console.log(selectedIds);

                // Set the selected IDs to the hidden input field
                document.getElementById('inActiveSelectedIds').value = selectedIds.join(',');

                // Submit the form
                document.getElementById('inActiveBtnForm').submit();
            }

            inActiveBtn.addEventListener("click", function() {
                var confirmInactive = confirm("Are you sure you want to Inactive the selected items?");
                if (confirmInactive) {
                    inActiveSelectedItems();
                }
            });

        });
    </script> --}}
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
