@extends('layouts.auth');
@section('title', 'Site Configs - Edit | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                              <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item"> <a href="{{ route('siteConfigs.index') }}">Site Config</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Site Config >
                                {{-- {{ $siteConfig->name }}</li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
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
                  <form action="{{ route('siteConfigs.update', $siteConfig->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Send Interest Setting</label>
                                <select name="interest_setting" class="form-control" required>
                                    <option value="0" {{ old('interest_setting',$siteConfig->interest_setting ) == 'All User Can Send' ? 'selected' : '' }}>All User
                                        can Send</option>
                                    <option value="1" {{ old('interest_setting',$siteConfig->interest_setting) == 'Paid User Can Send' ? 'selected' : '' }}>Only Paid
                                        User can Send</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Profile View Setting</label>
                                <select name="profile_view_setting" class="form-control" required>
                                    <option value="0" {{ old('profile_view_setting',$siteConfig->profile_view_setting) == 'All User Can View' ? 'selected' : '' }}>All
                                        User can View</option>
                                    <option value="1" {{ old('profile_view_setting',$siteConfig->profile_view_setting) == 'Paid User Can View' ? 'selected' : '' }}>Only
                                        Paid User Can View</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Profile Name Setting</label>
                                <select name="profile_name_setting" class="form-control" required>
                                    <option value="0" {{ old('profile_name_setting',$siteConfig->profile_name_setting) == 'Show Full Name' ? 'selected' : '' }}>Show
                                        Full Name</option>
                                    <option value="1" {{ old('profile_name_setting',$siteConfig->profile_name_setting) == 'Show Only First Name' ? 'selected' : '' }}>Show
                                        only First Name</option>
                                    <option value="2" {{ old('profile_name_setting',$siteConfig->profile_name_setting) == 'Hide Name' ? 'selected' : '' }}>Hide
                                        Name</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Profile Activation Setting</label>
                                <select name="profile_activation" class="form-control" required>
                                    <option value="0" {{ old('profile_activation',$siteConfig->profile_activation) == 'Activate vie OTP' ? 'selected' : '' }}>User
                                        Can Activate Profile vie OTP</option>
                                    <option value="1" {{ old('profile_activation',$siteConfig->profile_activation) == 'Activate via Admin' ? 'selected' : '' }}>User
                                        Profile Activate via Admin</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Profile Photo(Signup)</label>
                                <select name="profile_photo_setting" class="form-control" required>
                                    <option value="0" {{ old('profile_photo_setting',$siteConfig->profile_photo_setting) == 'Not-Mandatory' ? 'selected' : '' }}>
                                        Not-Mandatory</option>
                                    <option value="1" {{ old('profile_photo_setting',$siteConfig->profile_photo_setting) == 'Mandatory' ? 'selected' : '' }}>
                                        Mandatory</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Document Upload(Signup)</label>
                                <select name="profile_kyc_setting" class="form-control" required>
                                    <option value="0" {{ old('profile_kyc_setting',$siteConfig->profile_kyc_setting) == 'Not-Mandatory' ? 'selected' : '' }}>
                                        Not-Mandatory</option>
                                    <option value="1" {{ old('profile_kyc_setting',$siteConfig->profile_kyc_setting) == 'Mandatory' ? 'selected' : '' }}>
                                        Mandatory</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Success Story Last Year Option</label>
                                <input type="text" class="form-control" name="success_story_year_setting"
                                    placeholder="Enter Success Story Year " value="{{ $siteConfig->success_story_year_setting }}"
                                    required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Male Legal Age (In Years)</label>
                                <input type="text" class="form-control" name="male_legal_age"
                                    placeholder="Enter Male Legal Age " value="{{ $siteConfig->male_legal_age }}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Female Legal Age (In Years)</label>
                                <input type="text" class="form-control" name="female_legal_age"
                                    placeholder="Enter Female Legal Age " value="{{ $siteConfig->female_legal_age }}" required>
                            </div>
                            {{-- <div class="form-group col-lg-6">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="1" {{ old('status',$siteConfig->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status',$siteConfig->status) == 'Inactive' ? 'selected' : '' }}>Deactive</option>
                                </select>
                            </div> --}}
                            <div><label class="mr-3">Status</label></div>
                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio1" name="status" class="custom-control-input"
                                value="1" {{$siteConfig->status == 'Active' ? 'checked' : ''}}>
                            <label class="custom-control-label" for="customRadio1">Active</label>
                        </div>

                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                            <input type="radio" id="customRadio2" name="status" class="custom-control-input"
                                value="0" {{ $siteConfig->status == 'Inactive' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio2">Inactive</label>
                        </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            {{-- <x-submit-button-component 
                      buttonStyle="$buttonStyle->buttonStyle"
                      content="Update Site Setting "
                      /> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
