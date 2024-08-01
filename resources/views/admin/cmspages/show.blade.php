@extends('layouts.auth')
@section('title', 'CMS Page | Admin')
@section('content')
<div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item"> <a href="{{ route('cmsPages.index') }}">CMS Page</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Show > {{ $cmsPage->name ?? ''}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            
            <div class="card card-default">
                <div class="card-header">
                    {{$cmsPage->content}}
                </div>
            </div>
            
        </div>
    </div>

@endsection