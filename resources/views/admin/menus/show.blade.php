@extends('layouts.auth')
@section('title', 'Menus | Admin')
@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('admin/menus') }}"><span style="color: white">Header Menus</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @foreach ($menus as $menu)
                        {{-- @dd($menus) --}}
                        <li class="nav-item">
                            @if ($menu->name === 'Home')
                                <a class="nav-link active" aria-current="page" href="{{ $menu->url }}"><span
                                        style="color: white">{{ $menu->name }}</span></a>
                            @elseif($menu->name === 'Dashboard')
                                <a class="nav-link active" aria-current="page" href="{{ $menu->url }}"><span
                                        style="color: white">{{ $menu->name }}</span></a>
                            @elseif($menu->name === 'Admin')
                                <a class="nav-link active" aria-current="page" href="{{ $menu->url }}"><span
                                        style="color: white">{{ $menu->name }}</span></a>
                            @elseif($menu->name === 'abc')
                                <a class="nav-link active" aria-current="page" href="{{ $menu->url }}"><span
                                        style="color: white">{{ $menu->name }}</span></a>
                            @endif

                        </li>
                    @endforeach


                </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('admin/menus') }}"><span style="color: white">Footer Menus</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#footerNavbar"
                aria-controls="footerNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="footerNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @foreach ($footers as $footer)
                        <li class="nav-item">
                            @if ($footer->name === 'Faq-Page' || $footer->name === 'Privacy-Policy'|| $footer->name === 'Admin'|| $footer->name === 'abc'|| $footer->name === 'Dashboard'|| $footer->name === 'Home'|| $footer->name === 'Privacy-Policy' )
                                <a class="nav-link active" aria-current="page" href="{{ $footer->url }}"><span
                                        style="color: white">{{ $footer->name }}</span></a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>


@endsection
