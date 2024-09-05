@extends('layouts.auth')
@section('title', 'Admin Menus - Edit | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default  ">
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

            <!-- Parent Menu -->
            <div class="card card-default mb-3">
                <div class="card-body">
                    <div class="text-center">
                        <span class="btn btn-primary btn-sm mb-3">
                            @if ($parentMenus)
                                    <h4 style="color: white">Parent Menu</h4>
                                @endif
                        </span>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('adminMenus.update', $adminMenu->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Menu Name"
                                    value="{{ $adminMenu->name ?? '' }}" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="parent_id">Parent Menu</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">No Parent</option>
                                    @foreach ($parentMenus as $parentMenu)
                                        <option value="{{ $parentMenu->id }}">
                                            {{ $parentMenu->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="icon">Icon</label>
                                <input type="text" name="icon" class="form-control"
                                    value="{{ $adminMenu->icon ?? '' }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="1" {{ $adminMenu->status == 'Active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ $adminMenu->status == 'Inactive' ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Url</label>
                                <input type="text" name="url" class="form-control"
                                    value="{{ $adminMenu->url ?? '' }}">
                            </div>
                            
                        </div>
                        <div class="text-center">
                            <x-submit-button-component buttonStyle="$buttonStyle->buttonStyle"
                                content="Update Admin Menu" />
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sub Menus -->
            <div class="row">
                @foreach ($adminMenu->children as $subMenu)
                    <div class="col-lg-6 mb-4">
                        <div class="card card-default">
                            <div class="card-body">
                                <div class="text-center">
                                    <span class="btn btn-primary btn-sm mb-3">
                                        <h4 style="color: white">{{ $subMenu->name }}</h4>
                                    </span>
                                </div>
                                <form action="{{ route('adminMenus.update', $subMenu->id) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Enter Menu Name" value="{{ $subMenu->name }}" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="parent_id">Parent Menu</label>
                                            <select name="parent_id" class="form-control">
                                                <option value="">No Parent</option>
                                                @foreach ($parentMenus as $parentMenu)
                                                    <option value="{{ $parentMenu->id }}"
                                                        {{ old('parent_id', $subMenu->parent_id) == $parentMenu->id ? 'selected' : '' }}>
                                                        {{ $parentMenu->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="icon">Icon</label>
                                            <input type="text" name="icon" class="form-control"
                                                value="{{ $subMenu->icon ?? '' }}">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Status</label>
                                            <select name="status" class="form-control" required>
                                                <option value="1"
                                                    {{ $subMenu->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="0"
                                                    {{ $subMenu->status == 'Inactive' ? 'selected' : '' }}>Inactive
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Url</label>
                                            <input type="text" name="url" class="form-control"
                                                value="{{ $subMenu->url ?? '' }}">
                                        </div>
                                        
                                    </div>
                                    <div class="text-center">
                                        <x-submit-button-component buttonStyle="$buttonStyle->buttonStyle"
                                            content="Update Sub Menu" />
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Child Menus -->
                        @foreach ($subMenu->children as $child)
                            @if ($child->parent_id == $subMenu->id)
                                <div class="card card-default mt-4">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <span class="btn btn-primary btn-sm mb-3">
                                                <h4 style="color: white">{{ $subMenu->name }} - {{ $child->name }}</h4>
                                            </span>
                                        </div>
                                        <form action="{{ route('adminMenus.update', $child->id) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <div class="row">
                                                <div class="form-group col-lg-6">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Enter Menu Name" value="{{ $child->name }}"
                                                        required>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label for="parent_id">Parent Menu</label>
                                                    <select name="parent_id" class="form-control">
                                                        <option value="{{ $subMenu->id }}"
                                                            {{ old('parent_id', $child->parent_id) == $subMenu->id ? 'selected' : '' }}>
                                                            {{ $subMenu->name }}
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label for="icon">Icon</label>
                                                    <input type="text" name="icon" class="form-control"
                                                        value="{{ $child->icon ?? '' }}">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control" required>
                                                        <option value="1"
                                                            {{ $child->status == 'Active' ? 'selected' : '' }}>Active
                                                        </option>
                                                        <option value="0"
                                                            {{ $child->status == 'Inactive' ? 'selected' : '' }}>Inactive
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label>Url</label>
                                                    <input type="text" name="url" class="form-control"
                                                        value="{{ $child->url ?? '' }}">
                                                </div>
                                               
                                            </div>
                                            <div class="text-center">
                                                <x-submit-button-component buttonStyle="$buttonStyle->buttonStyle"
                                                    content="Update Child Menu" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection



























































{{-- @extends('layouts.auth');
@section('title', 'Admin Menus - Edit | Admin')
@section('content')
    <div class="content-wrapper ">
        <div class="content">
            <div class="card card-default  ">
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

            @foreach ($adminMenus as $adminMenu)
                <div class="card card-default ">
                    <div class="card-body">
                        <div class="text-center col-lg-12">
                            <span class="btn btn-primary btn-sm mb-3">
                                @if (is_null($adminMenu->parent_id))
                                    <h4 style="color: white">Parent Menu</h4>
                                @endif
                            </span>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('adminMenus.update', $adminMenu->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <label>Name</label>

                                    <input type="text" class="form-control" name="name" placeholder="Enter Menu Name"
                                        value="{{ $adminMenu->name ?? '' }}" required>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="parent_id">Parent Menu</label>
                                    <select name="parent_id" class="form-control">
                                        <option value="">No Parent</option>
                                        @foreach ($parentMenus as $parentMenu)
                                            <option value="{{ $parentMenu->id }}">
                                                {{ $parentMenu->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-group col-lg-4">
                                    <label for="icon">Icon</label>
                                    <input type="text" name="icon" class="form-control"
                                        value="{{ $adminMenu->icon ?? '' }}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Url</label>
                                    <input type="text" name="url" class="form-control"
                                        value="{{ $adminMenu->url ?? '' }}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Status</label>

                                    <select name="status" class="form-control" required>
                                        <option value="1" {{ $adminMenu->status == 'Active' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="0" {{ $adminMenu->status == 'Inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <x-submit-button-component buttonStyle="$buttonStyle->buttonStyle"
                                    content="Create Site Setting " />
                            </div>
                        </form>
                    </div>
                </div>
                 @foreach ($adminMenu->children as $subMenu)
                 
                       @foreach ($subMenu->subChildren as $child)
                       @endforeach
                     
                       @if ($subMenu->parent_id == $adminMenu->id && isset($child) && $subMenu->id == $child->parent_id)
                       <div class="card card-default">
                           <div class="card-body">
                               <div class="text-center col-lg-12">
                                   <span class="btn btn-primary btn-sm mb-3">
                                       <h4 style="color: white">{{ $subMenu->name }}</h4>
                                   </span>
                               </div>
                               @if ($errors->any())
                                   <div class="alert alert-danger">
                                       <ul>
                                           @foreach ($errors->all() as $error)
                                               <li>{{ $error }}</li>
                                           @endforeach
                                       </ul>
                                   </div>
                               @endif
                               <form action="{{ route('adminMenus.update', $subMenu->id) }}" method="post">
                                   @csrf
                                   @method('PATCH')
                                   <div class="row">
                                       <div class="form-group col-lg-4">
                                           <label>Name</label>
                                           <input type="text" class="form-control" name="name" placeholder="Enter Menu Name" value="{{ $subMenu->name }}" required>
                                       </div>
                                       <div class="form-group col-lg-4">
                                           <label for="parent_id">Parent Menu</label>
                                           <select name="parent_id" class="form-control">
                                               <option value="">No Parent</option>
                                               @foreach ($parentMenus as $parentMenu)
                                                   <option value="{{ $parentMenu->id }}" {{ old('parent_id', $subMenu->parent_id) == $parentMenu->id ? 'selected' : '' }}>
                                                       {{ $parentMenu->name }}
                                                   </option>
                                               @endforeach
                                           </select>
                                       </div>
                                       <div class="form-group col-lg-4">
                                           <label for="icon">Icon</label>
                                           <input type="text" name="icon" class="form-control" value="{{ $adminMenu->icon ?? '' }}">
                                       </div>
                                       <div class="form-group col-lg-6">
                                           <label>Url</label>
                                           <input type="text" name="url" class="form-control" value="{{ $subMenu->url ?? '' }}">
                                       </div>
                                       <div class="form-group col-lg-6">
                                           <label>Status</label>
                                           <select name="status" class="form-control" required>
                                               <option value="1" {{ $subMenu->status == 'Active' ? 'selected' : '' }}>Active</option>
                                               <option value="0" {{ $subMenu->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="text-center">
                                       <x-submit-button-component buttonStyle="$buttonStyle->buttonStyle" content="Create Site Setting" />
                                   </div>
                               </form>
                           </div>
                       </div>
                   @else
                   <div class="row"></div>
                   <div class="col-lg-6 mb-4">
                   <div class="card card-default">
                    <div class="card-body">
                        <div class="text-center col-lg-12">
                            <span class="btn btn-primary btn-sm mb-3">
                                <h4 style="color: white">{{ $subMenu->name }}</h4>
                            </span>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('adminMenus.update', $subMenu->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Menu Name" value="{{ $subMenu->name }}" required>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="parent_id">Parent Menu</label>
                                    <select name="parent_id" class="form-control">
                                        <option value="">No Parent</option>
                                        @foreach ($parentMenus as $parentMenu)
                                            <option value="{{ $parentMenu->id }}" {{ old('parent_id', $subMenu->parent_id) == $parentMenu->id ? 'selected' : '' }}>
                                                {{ $parentMenu->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="icon">Icon</label>
                                    <input type="text" name="icon" class="form-control" value="{{ $adminMenu->icon ?? '' }}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Url</label>
                                    <input type="text" name="url" class="form-control" value="{{ $subMenu->url ?? '' }}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1" {{ $subMenu->status == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $subMenu->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <x-submit-button-component buttonStyle="$buttonStyle->buttonStyle" content="Create Site Setting" />
                            </div>
                        </form>
                    </div>
                </div>
                   @endif
                   
                         <div class="row">
                            @foreach ($subMenu->subChildren as $child)
                                @if ($child->parent_id == $subMenu->id)
                                    <div class="col-lg-6 mb-4">
                                        <div class="card card-default">
                                            <div class="card-body">
                                                <div class="text-center col-lg-12">
                                                    <span class="btn btn-primary btn-sm mb-3">
                                                        <h4 style="color: white">{{ $subMenu->name}} - {{$child->name }}</h4>
                                                    </span>
                                                </div>
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                @dump($child->id)
                                                <form action="{{ route('adminMenus.update', $child->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="row">
                                                        <div class="form-group col-lg-4">
                                                            <label>Name</label>

                                                            <input type="text" class="form-control" name="name"
                                                                placeholder="Enter Menu Name" value="{{ $child->name }}"
                                                                required>
                                                        </div>
                                                        <div class="form-group col-lg-4">
                                                            <label for="parent_id">Parent Menu</label>
                                                            <select name="parent_id" class="form-control">
                                                                <option value="">No Parent</option>
                                                              
                                                                    <option value="{{ $subMenu->id }}"
                                                                        {{ old('parent_id', $child->parent_id) == $subMenu->id ? 'selected' : '' }}>
                                                                        {{ $subMenu->name }}
                                                                    </option>
                                                                
                                                            </select>

                                                        </div>
                                                        <div class="form-group col-lg-4">
                                                            <label for="icon">Icon</label>
                                                            <input type="text" name="icon" class="form-control"
                                                                value="{{ $child->icon ?? '' }}">
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <label>Url</label>
                                                            <input type="text" name="url" class="form-control"
                                                                value="{{ $child->url ?? '' }}">
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <label>Status</label>
                                                            <select name="status" class="form-control" required>
                                                                <option value="1"
                                                                    {{ $child->status == 'Active' ? 'selected' : '' }}>
                                                                    Active</option>
                                                                <option value="0"
                                                                    {{ $child->status == 'Inactive' ? 'selected' : '' }}>
                                                                    Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <x-submit-button-component buttonStyle="$buttonStyle->buttonStyle"
                                                            content="Create Site Setting" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
               
            @endforeach

        </div>
    </div>
@endsection --}}
