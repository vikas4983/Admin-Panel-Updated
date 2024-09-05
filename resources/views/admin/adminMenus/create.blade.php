@extends('layouts.auth')
@section('title', 'Admin Menus - Create | Admin')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                        <li class="breadcrumb-item"> <a href="{{ route('adminMenus.index') }}">Admin Menu</a> </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Admin Menu</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="text-center">
            <div class="card card-default col-lg-8 mx-auto"> <!-- Added mx-auto class here -->
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('adminMenus.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Menu Name" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="parent_id">Parent Menu</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">No Parent</option>
                                    @foreach ($adminMenus as $parentMenu)
                                        <option value="{{ $parentMenu->id }}">
                                            {{ $parentMenu->name }}
                                            @if(count($parentMenu->childrenRecursive) > 0)
                                                @include('menus', ['subMenus' => $parentMenu->childrenRecursive, 'parent' => $parentMenu->name])
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="icon">Icon</label>
                                <input type="text" name="icon" class="form-control" value="{{ old('icon') }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Url</label>
                                <input type="text" name="url" class="form-control" value="{{ old('url') }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <x-submit-button-component buttonStyle="$buttonStyle->buttonStyle" content="Create Site Setting" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




















































{{-- <ul>
    @foreach($adminMenus as $child)
        <li class="tree-view {{ $child->children->count() ? 'closed' : '' }}">
            <a class="tree-name">{{ $child->name }}</a>
            @if($child->children->count())
                <ul>
                    @foreach($child->children as $grandchild)
                        <li class="tree-view {{ $grandchild->children->count() ? 'closed' : '' }}">
                            <a class="tree-name">{{ $grandchild->name }}</a>
                            @if($grandchild->children->count())
                                <ul>
                                    @foreach($grandchild->children as $greatGrandchild)
                                        <li class="tree-view">
                                            <a class="tree-name">{{ $greatGrandchild->name }}</a>
                                            <!-- You can go deeper if needed -->
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul> --}}