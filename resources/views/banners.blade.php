
@extends('layouts.auth')
@section('title', 'Banners | Admin')
@section('content')
<div>
<img src="{{asset('storage/admin/banners/banner1.jpg')}}" alt="Banner Image" style="width: 100%;
            height: 100vh; /* 100% of the viewport height */
            object-fit: cover;">
</div>
@endsection

