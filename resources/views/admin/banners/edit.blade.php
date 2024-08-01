 @extends('layouts.auth');
 @section('title', 'Banner - Edit | Admin')

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Document</title>
     <link rel="stylesheet" href="{{ asset('css/custom-css/previouseLogo.css') }}">
 </head>

 <body>

     @section('content')
         <div class="content-wrapper">
             <div class="content">
                 <div class="card card-default">
                     <div class="card-header">
                         <nav aria-label="breadcrumb">
                             <ol class="breadcrumb">
                                  <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                                 <li class="breadcrumb-item"> <a href="{{ route('banners.index') }}">Banner</a> </li>
                                 <li class="breadcrumb-item active" aria-current="page">Edit Banner
                                 </li>
                             </ol>
                         </nav>
                     </div>
                 </div>

                 @if ($banner)
                     <div class="card card-default">
                         <div class="card-body">
                             {{-- Display Error Msg --}}
                             @if ($errors->any())
                                 <div class="alert alert-danger">
                                     <ul>
                                         @foreach ($errors->all() as $error)
                                             <li>{{ $error }}</li>
                                         @endforeach
                                     </ul>
                                 </div>
                             @endif
                             {{-- Display Success Msg --}}
                             {{-- @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif --}}

                             {{-- @dd($banner->id) --}}
                             <form action="{{ route('banners.update', $banner->id) }}" method="post"
                                 enctype="multipart/form-data">
                                 @csrf
                                 @method('PATCH')

                                 <div class="form-group">

                                     <img src="{{ asset('storage/admin/banners/' . ($banner->name ?? '')) }}" alt=""
                                        
                                         style="margin-left: 604px;
                                                padding:;
                                               
                                                max-width: 200px;
                                                margin-top: -16px;
                                                margin-bottom: -39px;
                                                ">
                                 </div>
                                 <div class="form-group">
                                     <label>Upload New Banner</label>
                                     <input type="file" class="form-control" name="banner">
                                 </div>
                                 {{-- <div class="form-group">
                                     <label>Status</label>
                                     <select name="status" id="" class="form-control">
                                         <option value="1" {{ old('status', $banner->status) == 1 ? 'selected' : '' }}>
                                             Active
                                         </option>
                                         <option value="0" {{ old('status', $banner->status) == 0 ? 'selected' : '' }}>
                                             Deactive
                                         </option>
                                     </select>
                                 </div> --}}
                                 <div><label>Status</label></div>
                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio1" name="status" class="custom-control-input"
                                value="1" {{$banner->status == 'Active' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="customRadio1">Active</label>
                        </div>

                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio2" name="status" class="custom-control-input"
                                value="0" {{ $banner->status == 'Inactive' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio2">Inactive</label>
                        </div>
                                 {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                                 <div class="text-center">
                            {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                             <x-submit-button-component 
                      buttonStyle="$buttonStyle->buttonStyle"
                      content="Upload Banner"
                      />
                             </form>

                         </div>
                     </div>
                 @endif

             </div>
         </div>
     @endsection

 </body>

 </html>
