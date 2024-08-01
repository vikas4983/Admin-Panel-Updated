@extends('layouts.auth')
@section('title', 'Banner | Admin')
@section('content')
<div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                              <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                                 <li class="breadcrumb-item"> <a href="{{ route('banners.index') }}">Banner</a> </li>
                                 <li class="breadcrumb-item active" aria-current="page">Show
                        </ol>
                    </nav>

                     {{-- <span> <x-create-button-component 
                            createRoute="{{ url('admin/banners/create') }}"
                            activeRoute="{{ url('admin/banners-active') }}"
                            deleteAllRoute="{{ url('admin/banners-destroy') }}"
                            inActiveRoute="{{ url('admin/banners-inActive') }}"
                            countAll="{{ $countAll }}"
                            active="{{ $active }}" inActive="{{ $inActive }}">
                        </x-create-button-component></span> --}}
                </div>
            </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{url('admin/banners')}}"><span style="color: white">Banners</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @foreach ($cmsPages as $cmsPage)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('admin/cmsPages', $cmsPage->slug) }}"><span style="color: white">{{ $cmsPage->name }}</span></a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
   
    <img src="{{ asset('storage/admin/banners/' . ($banner->name ?? '')) }}" alt="Banner"
        style="width: 100%;
            height: 100vh; /* 100% of the viewport height */
            object-fit: 
                                                ">
@endsection
