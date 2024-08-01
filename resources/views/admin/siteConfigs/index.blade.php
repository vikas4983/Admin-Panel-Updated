@extends('layouts.auth')
@section('title', 'Site Configs | Admin')
@section('styles')
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
    <script src="http://datatables.net/release-datatables/media/js/jquery.js"></script>
    <script src="http://datatables.net/release-datatables/media/js/jquery.dataTables.js"></script>
    <script src="http://datatables.net/release-datatables/extensions/Scroller/js/dataTables.scroller.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="{{ asset('assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}"
        rel="stylesheet" />
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                {{-- <h3 class="card-header">
                Incomes</h3> --}}
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"> <a href="{{ url('dashboard') }}">Home</a> </li>
                            <li class="breadcrumb-item active" aria-current="page">Site Config</li>
                        </ol>
                    </nav>
                    {{-- <span> <x-create-button-component createRoute="{{ url('admin/menus/create') }}"
                            activeRoute="{{ url('admin/menus-active') }}" deleteAllRoute="{{ url('admin/menus-destroy') }}"
                            inActiveRoute="{{ url('admin/menus-inActive') }}" countAll="{{ $countAll }}"
                            active="{{ $active }}" inActive="{{ $inActive }}">
                        </x-create-button-component></span> --}}
                </div>
            </div>

            <div class="card card-default">
                <div class="card-header">
                    @if (count($siteConfigs) > 0)
                        {{-- <table class="table " id="menus" class="display nowrap" width="100%"> --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    {{-- <th scope="col"><input type="checkbox" id="allCheckbox"></th> --}}
                                    <th scope="col">Action</th>
                                    <th scope="col">Send Interest</th>
                                    <th scope="col">Profile View</th>
                                    <th scope="col">Profile Name</th>
                                    <th scope="col">Profile Activation</th>
                                    {{-- <th scope="col">Profile Photo</th>
                                    <th scope="col">Document Upload</th>
                                    <th scope="col">Success Story</th>
                                    <th scope="col">Male Legal Age</th>
                                    <th scope="col">Female Legal Age</th>
                                    <th scope="col">Demo</th> --}}


                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = ($siteConfigs->currentPage() - 1) * $siteConfigs->perPage() + 1;
                                @endphp
                                @foreach ($siteConfigs as $siteConfig)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        {{-- <td><input type="checkbox" class="selectCheckbox" name="selectedHeadersIds[]"
                                                    value="{{ $header->id }}"></td> --}}
                                        <td>
                                            <x-action-button
                                                destroyRoute="{{ route('siteConfigs.destroy', $siteConfig->id) }}"
                                                editRoute="{{ route('siteConfigs.edit', $siteConfig->id) }}"
                                                id="$siteConfig->id" entityType="'siteConfigs'">
                                            </x-action-button>
                                            {{-- <a  href="{{ route('siteConfigs.show', $siteConfig->id) }}" >Show</a> --}}
                                            <button type="button" class="mr-1 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle"" data-toggle="modal"
                                                data-target="#exampleModal">
                                                <i class="fa fa-eye"></i>
                                            </button>

                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header d-flex justify-content-center">
                                                            <h5 class="modal-title" id="exampleModalLabel">Site COnfig</h5>
                                                            <button type="button" class="close position-absolute"
                                                                style="right: 1rem;" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        {{-- <div class="modal-body">
                                                            Modal body text goes here.
                                                        </div> --}}
                                                        <form action="{{ route('siteConfigs.update', $siteConfig->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label class="mr-3">Send Interest Setting</label>
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
                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            {{-- <x-submit-button-component 
                      buttonStyle="$buttonStyle->buttonStyle"
                      content="Update Site Setting "
                      /> --}}
                        </div>
                    </form>
                                                        {{-- <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger btn-pill"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary btn-pill">Save
                                                                Changes</button>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><x-status-component :status="$siteConfig->status" />{{ $siteConfig->interest_setting }}</td>
                                        <td>{{ $siteConfig->profile_view_setting }}</td>
                                        <td>{{ $siteConfig->profile_name_setting }}</td>
                                        <td>{{ $siteConfig->profile_activation }}</td>
                                        {{-- <td>{{$siteConfig->profile_photo_setting}}</td>
                                        <td>{{$siteConfig->profile_kyc_setting}}</td>
                                        <td>{{$siteConfig->success_story_year_setting}}</td>
                                        <td>{{$siteConfig->male_legal_age}}</td>
                                        <td>{{$siteConfig->female_legal_age}}</td>
                                        <td>@if ($siteConfig->demo1 == 1)
                                            {{$siteConfig->demo1}}
                                            @else
                                            <span style="color: red">Screaing</span>
                                        @endif
                                    </td> --}}


                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <span>{{ $siteConfigs->links() }}</span>

                        </div>
                    @else()
                        <h3 class="text-center text-danger">No Site Setting found</h3>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <script></script>
@endsection
