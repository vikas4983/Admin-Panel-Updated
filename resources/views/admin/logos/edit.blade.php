 @extends('layouts.auth');
 @section('title', 'Logo & Favicon - Edit | Admin')

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
                                 <li class="breadcrumb-item"> <a href="{{ route('logos.index') }}">Logo</a> </li>
                                 <li class="breadcrumb-item active" aria-current="page">Edit Logo 
                                 </li>
                             </ol>
                         </nav>
                     </div>
                 </div>

                 @if ($logo)
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

                             {{-- @dump($logofavicon) --}}
                             <form action="{{ route('logos.update', $logo->id) }}" method="post"
                                 enctype="multipart/form-data">
                                 @csrf
                                 @method('PATCH')

                                 <div class="form-group">

                                     <img src="{{ asset('storage/admin/logo-favicon/logos/' . ($logo->name ?? '')) }}" alt=""
                                         class="previouseImage"
                                         style="margin-left: 604px;
                                                padding:;
                                                max-height: 70px;
                                                margin-top: -14px;
                                                margin-bottom: -37px;
                                                ">
                                 </div>
                                 <div class="form-group">
                                     <label>Upload New Logo</label>
                                     <input type="file" class="form-control" name="logo">
                                 </div>
                                 {{-- <div class="form-group">
                                     <label>Status</label>
                                     <select name="status" id="" class="form-control">
                                         <option value="1" {{ old('status', $logo->status) == 1 ? 'selected' : '' }}>
                                             Active
                                         </option>
                                         <option value="0" {{ old('status', $logo->status) == 0 ? 'selected' : '' }}>
                                             Deactive
                                         </option>
                                     </select>
                                 </div> --}}
                                 <div><label>Status</label></div>
                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio1" name="status" class="custom-control-input"
                                value="1" {{$logo->status == 'Active' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="customRadio1">Active</label>
                        </div>

                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio2" name="status" class="custom-control-input"
                                value="0" {{ $logo->status == 'Inactive' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio2">Inactive</label>
                        </div>
                                 {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                                  <x-submit-button-component 
                      buttonStyle="$buttonStyle->buttonStyle"
                      content="Update Logo"
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
