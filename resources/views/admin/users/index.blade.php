@extends('layouts.auth')
@section('title', 'Members | Admin')
@section('content')

    <body class="navbar-fixed sidebar-fixed" id="body">
        <script>
            NProgress.configure({
                showSpinner: false
            });
            NProgress.start();
        </script>
        <div class="wrapper">
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <!-- Frist box -->
                        <div class="col-xl-3 col-md-6">
                              <a href="{{ route('users.index') }}" class="text-decoration-none">
                            <div class="card card-default bg-secondary">
                                <div class="d-flex p-5">
                                    <div class="icon-md bg-white rounded-circle mr-3">
                                        <i class="mdi mdi-account-plus-outline text-secondary"></i>
                                    </div>
                                    <div class="text-left">
                                        <span class="h2 d-block text-white">{{$countAll ?? ''}}</span>
                                        <p class="text-white">All Users</p>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>

                        <!-- Second box -->
                        <div class="col-xl-3 col-md-6">
                              <a href="{{ route('users.index',['paidUsers' => 'users']) }}" class="text-decoration-none">
                            <div class="card card-default bg-success">
                                <div class="d-flex p-5">
                                    <div class="icon-md bg-white rounded-circle mr-3">
                                        <i class="mdi mdi-chess-queen" style="color:#FD5190"></i>
                                    </div>
                                    <div class="text-left">
                                        <span class="h2 d-block text-white">{{$premiumUsersCount ?? ''}}</span>
                                        <p class="text-white">Premium Users</p>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>

                        <!-- Third box -->
                        <div class="col-xl-3 col-md-6">
                              <a href="{{ route('users.index', ['activeUsers' => 'Users']) }}" class="text-decoration-none">
                            <div class="card card-default bg-primary">
                                <div class="d-flex p-5">
                                    <div class="icon-md bg-white rounded-circle mr-3">
                                        <i class="mdi mdi-account-multiple-check" style="color:#FD5190"></i>
                                    </div>
                                    <div class="text-left">
                                        <span class="h2 d-block text-white">{{$active ?? ''}}</span>
                                        <p class="text-white">Active Users</p>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>

                        <!-- Fourth box -->
                        <div class="col-xl-3 col-md-6">
                              <a href="{{ route('users.index', ['inActiveUsers' => 'Users']) }}" class="text-decoration-none">
                            <div class="card card-default bg-info">
                                <div class="d-flex p-5">
                                    <div class="icon-md bg-white rounded-circle mr-3">
                                        <i class="mdi mdi-account-off" style="color:#FD5190"></i>
                                    </div>
                                    <div class="text-left">
                                        <span class="h2 d-block text-white">{{$inActive ?? ''}}</span>
                                        <p class="text-white">InActive Users</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>


                    <div class="row">
                        @if (!empty($users))
                            <x-users-component :users="$users" />
                        @endif
                    </div>
                    <div class="row">
                        @if (!empty($paidUsers) && !empty($profilePrefixs))
                            <x-paid-users-component :paidUsers="$paidUsers" :profilePrefixs="$profilePrefixs" />
                        @endif
                    </div>
                    <div class="row">
                        @if (!empty($activeUsers) && !empty($profilePrefixs))
                            <x-active-users-component :activeUsers="$activeUsers" :profilePrefixs="$profilePrefixs" />
                        @endif
                    </div>
                    <div class="row">
                        @if (!empty($inActiveUsers) && !empty($profilePrefixs))
                            <x-in-active-users-component :inActiveUsers="$inActiveUsers" :profilePrefixs="$profilePrefixs" />
                        @endif

                    </div>


                </div>
            </div>
        </div>
    </body>
@endsection
