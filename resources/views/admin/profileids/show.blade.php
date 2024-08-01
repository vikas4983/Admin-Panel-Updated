@extends('layouts.auth')
@section('title', 'Menus | Admin')
@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('admin/menus') }}"><span style="color: white">Menus</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @foreach ($menus as $menu)
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ $menu->url }}"><span
                                    style="color: white">{{ $menu->name }}</span></a>

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
