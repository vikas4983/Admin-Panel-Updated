@extends('layouts.auth')
@section('title', 'Dashboard | Admin')
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
    {{-- @dump(session()->all()); --}}
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <!-- Frist box -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('countries.index') }}" style="color: inherit">
                            <div class="d-flex p-5">
                                <div class="icon-md bg-secondary rounded-circle mr-3">
                                    <i class="mdi mdi-earth"></i>
                                </div>

                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['countries'] ?? '' }}</span>
                                    <p>Countries</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Second box -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('states.index') }}" style="color: inherit">

                            <div class="d-flex p-5">
                                <div class="icon-md bg-success rounded-circle mr-3">
                                    <i class="mdi mdi-map-marker-radius

\f444"></i>
                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['states'] ?? '' }}</span>


                                    <p>States</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                <!-- Third box -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('cities.index') }}" style="color: inherit">
                            <div class="d-flex p-5">
                                <div class="icon-md bg-primary rounded-circle mr-3">
                                    <i class="mdi mdi-city"></i>
                                </div>
                                <div class="text-left">
                                    <span class="h2 d-block">{{ $count['cities'] ?? '' }}</span>
                                    <p>Cities</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                <!-- Fourth box -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('educations.index') }}" style="color: inherit">

                            <div class="d-flex p-5">
                                <div class="icon-md bg-info rounded-circle mr-3">
                                    <i class="mdi mdi-book"></i>
                                </div>
                                <div class="text-left">
                                    <span class="h2 d-block">{{ $count['educations'] ?? '' }}</span>
                                    <p>Educations</p>
                                </div>
                            </div>
                    </div>
                    </a>

                </div>
            </div>

            <div class="row">
                <!-- Frist box -->
                <div class="col-xl-3 col-md-6">

                    <div class="card card-default">
                        <a href="{{ route('religions.index') }}" style="color: inherit">


                            <div class="d-flex p-5">
                                <div class="icon-md bg-secondary rounded-circle mr-3">
                                    <i class="mdi mdi-hinduism"></i>
                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['religions'] ?? '' }}</span>
                                    <p>Religions</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Second box -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('castes.index') }}" style="color: inherit">

                            <div class="d-flex p-5">
                                <div class="icon-md bg-success rounded-circle mr-3">
                                    <i class="mdi mdi-human-female-female"></i>


                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['castes'] ?? '' }}</span>
                                    <p>Castes</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                <!-- Third box -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('incomes.index') }}" style="color: inherit">

                            <div class="d-flex p-5">
                                <div class="icon-md bg-primary rounded-circle mr-3">
                                    <i class="mdi mdi-currency-inr"></i>

                                </div>
                                <div class="text-left">
                                    <span class="h2 d-block">{{ $count['incomes'] ?? '' }}</span>
                                    <p>Incomes</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
                <!-- Fourth box -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('occupations.index') }}" style="color: inherit">

                            <div class="d-flex p-5">
                                <div class="icon-md bg-info rounded-circle mr-3">
                                    <i class="mdi mdi-briefcase"></i>
                                </div>
                                <div class="text-left">
                                    <span class="h2 d-block">{{ $count['occupations'] ?? '' }}</span>
                                    <p>Occupations</p>
                                </div>
                            </div>
                    </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <!-- Frist box -->
                <div class="col-xl-3 col-md-6">

                    <div class="card card-default">
                        <a href="{{ route('admins.index') }}" style="color: inherit">


                            <div class="d-flex p-5">
                                <div class="icon-md bg-secondary rounded-circle mr-3">
                                    <i class="mdi mdi-account-key"></i>


                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['admins'] ?? '' }}</span>
                                    <p>Admins</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Second box -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('plans.index') }}" style="color: inherit">
                            <div class="d-flex p-5">
                                <div class="icon-md bg-success rounded-circle mr-3">
                                    <i class="mdi mdi-chess-queen"></i>
                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['plans'] ?? '' }}</span>
                                    <p>Plans</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('employees.index') }}" style="color: inherit">
                            <div class="d-flex p-5">
                                <div class="icon-md bg-primary rounded-circle mr-3">
                                    <i class="mdi mdi-account-group"></i>
                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['employees'] ?? '' }}</span>
                                    <p>Employeed In</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('cmsPages.index') }}" style="color: inherit">
                            <div class="d-flex p-5">
                                <div class="icon-md bg-info rounded-circle mr-3">
                                    <i class="mdi mdi-file-multiple"></i>
                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['cmsPages'] ?? '' }}</span>
                                    <p>CMS Pages</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Frist box -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('logos.index') }}" style="color: inherit">


                            <div class="d-flex p-5">
                                <div class="icon-md bg-secondary rounded-circle mr-3">
                                    <i class="mdi mdi-account-key"></i>


                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['logos'] ?? '' }}</span>
                                    <p>Logos</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Second box -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('favicons.index') }}" style="color: inherit">
                            <div class="d-flex p-5">
                                <div class="icon-md bg-success rounded-circle mr-3">
                                    <i class="mdi mdi-chess-queen"></i>
                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['favicons'] ?? '' }}</span>
                                    <p>Favicons</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('banners.index') }}" style="color: inherit">
                            <div class="d-flex p-5">
                                <div class="icon-md bg-primary rounded-circle mr-3">
                                    <i class="mdi mdi-home-plus"></i>
                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['banners'] ?? '' }}</span>
                                    <p>Banners</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('menus.index') }}" style="color: inherit">
                            <div class="d-flex p-5">
                                <div class="icon-md bg-info rounded-circle mr-3">
                                    <i class="mdi mdi-file-multiple"></i>
                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['menus'] ?? '' }}</span>
                                    <p>Menus</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('profileids.index') }}" style="color: inherit">


                            <div class="d-flex p-5">
                                <div class="icon-md bg-secondary rounded-circle mr-3">
                                    <i class="mdi mdi-bookmark-minus-outline"></i>


                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['profileids'] ?? '' }}</span>
                                    <p>Profile Id</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Second box -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('emailSettings.index') }}" style="color: inherit">
                            <div class="d-flex p-5">
                                <div class="icon-md bg-success rounded-circle mr-3">
                                    <i class="mdi mdi-message-settings-variant"></i>
                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['emailSettings'] ?? '' }}</span>
                                    <p>Email Setting</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('siteSettings.index') }}" style="color: inherit">
                            <div class="d-flex p-5">
                                <div class="icon-md bg-primary rounded-circle mr-3">
                                    <i class="mdi mdi-home-plus"></i>
                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['siteSettings'] ?? '' }}</span>
                                    <p>Site Setting</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('siteConfigs.index') }}" style="color: inherit">
                            <div class="d-flex p-5">
                                <div class="icon-md bg-info rounded-circle mr-3">
                                    <i class="mdi mdi-settings-outline"></i>
                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['siteConfigs'] ?? '' }}</span>
                                    <p>Site Config</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('approvals.index') }}" style="color: inherit">
                            <div class="d-flex p-5">
                                <div class="icon-md bg-secondary rounded-circle mr-3">
                                    <i class="mdi mdi-playlist-check"></i>
                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['approvals'] ?? '' }}</span>
                                    <p>Approvals</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-default">
                        <a href="{{ route('successStories.index') }}" style="color: inherit">
                            <div class="d-flex p-5">
                                <div class="icon-md bg-secondary rounded-circle mr-3">
                                    <i class="mdi mdi-heart-multiple"></i>
                                </div>
                                <div class=" text-left">
                                    <span class="h2 d-block">{{ $count['successStories'] ?? '' }}</span>
                                    <p>Success Stories</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

















































{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout> --}}
