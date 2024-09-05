@extends('layouts.auth') @section('title', 'Dashboard | Admin') @section('styles')
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script src="http://datatables.net/release-datatables/media/js/jquery.js"></script>
<script src="http://datatables.net/release-datatables/media/js/jquery.dataTables.js"></script>
<script src="http://datatables.net/release-datatables/extensions/Scroller/js/dataTables.scroller.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link href="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}"
    rel="stylesheet" /> @endsection @section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="row">

            @foreach ($adminMenus as $adminMenu)
                @if (($adminMenu && $adminMenu->count > 0) || $adminMenu->parent_id == null)
                    {{-- Parent Menus --}}
                    @if ($adminMenu->parent_id == null && $adminMenu->model_name == null && $adminMenu->count == null)
                    @else
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-default">
                                <a href="{{'/admin'. $adminMenu->url }}" style="color: inherit">
                                    <div class="d-flex p-5">
                                        <div class="icon-md bg-secondary rounded-circle mr-3">
                                            <i class="{{$adminMenu->icon}}"></i>
                                        </div>
                                        <div class=" text-left">
                                            <span class="h2 d-block">{{ $adminMenu->count }}</span>
                                            <p>{{ $adminMenu->name }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    {{-- Sub Menus --}}
                    @foreach ($adminMenu->childrenRecursive as $subMenu)
                        @if (isset($subMenu) && $subMenu->count > 0)
                            <div class="col-xl-3 col-md-6">
                                <div class="card card-default">
                                    <a href="{{'/admin'. $subMenu->url }}" style="color: inherit">
                                        <div class="d-flex p-5">
                                            <div class="icon-md bg-secondary rounded-circle mr-3">
                                                <i class="{{$subMenu->icon}}"></i>
                                            </div>
                                            <div class=" text-left">
                                                <span class="h2 d-block">{{ $subMenu->count }}</span>
                                                <p>{{ $subMenu->name }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection















































{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
</h2>
</x-slot>
<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
      <x-welcome />
    </div>
  </div>
</div>
</x-app-layout> --}}
