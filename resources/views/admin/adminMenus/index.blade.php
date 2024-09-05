@extends('layouts.auth')
@section('title', 'Admin Menu | Admin')
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
                    <div class="text-center col-lg-12">
                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Admin Menu</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header">

                    @if (count($adminMenus) > 0)
                        <table class="table table-striped" id="adminMenus">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Parent Menu</th>
                                    <th scope="col">Sub Menu</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $count = ($adminMenus->currentPage() - 1) * $adminMenus->perPage() + 1;
                                @endphp
                                @foreach ($adminMenus as $adminMenu)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>
                                            <div class="d-flex flex-row">
                                                <x-edit-action-button-component :editRoute="route('adminMenus.edit', $adminMenu->id)" :id="$adminMenu->id" />
                                                <x-destroy-action-button-component :destroyRoute="route('adminMenus.destroy', $adminMenu->id)" :id="$adminMenu->id" />
                                            </div>
                                        </td>
                                        <td>
                                            <x-status-component :status="$adminMenu->status" />
                                            {{ $adminMenu->name }}
                                        </td>

                                        @if ($adminMenu->children->isNotEmpty())
                                        <td>
                                            <div class="menu-line" style="display: flex; flex-wrap: wrap; gap: 10px;">
                                                @foreach ($adminMenu->children as $child)
                                                    <span>
                                                        <x-destroy-button-component :destroyRoute="route('adminMenus.destroy', $child->id)"
                                                            :id="$child->id" :name="$child->name" />
                                                    </span>
                                                    
                                                    @if ($child->childrenRecursive->isNotEmpty())
                                                        @if ($child->childrenRecursive->count() > 1)
                                                            @foreach ($child->childrenRecursive as $item)
                                                                <span>
                                                                    <x-destroy-button-component :destroyRoute="route('adminMenus.destroy', $item->id)"
                                                                        :id="$item->id" :name="$item->name" />
                                                                </span>
                                                            @endforeach
                                                        @else
                                                            <span>
                                                                <x-destroy-button-component :destroyRoute="route('adminMenus.destroy', $child->childrenRecursive->first()->id)"
                                                                    :id="$child->childrenRecursive->first()->id" :name="$child->childrenRecursive->first()->name" />
                                                            </span>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        
                                        
                                        
                                        @else
                                            <td><a href="{{ route('adminMenus.create') }}"
                                                    value="{{ $adminMenu->id }}">Create Sub Menu</a></td>
                                        @endif
                                    </tr>

                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <span>{{ $adminMenus->links() }}</span>

                        </div>
                    @else()
                        <h3 class="text-center text-danger">No Plane found</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#adminMenus').DataTable();
            $(".dataTables_wrapper").css("width", "100%");
        });
    </script>
@endsection
