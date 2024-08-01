@extends('layouts.auth')
@section('title', 'Members | Admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <style>
        /* Ensure the nav container uses Flexbox and centers its items */
        .nav-custom-pills {
            display: flex;
            justify-content: center;
            /* Center horizontally */
            flex-wrap: nowrap;
            /* Prevent wrapping */
        }

        .nav-custom-pills .nav-item {
            margin: 0 5px;
            /* Adjust spacing between nav items */
        }

        .nav-custom-pills .nav-link {
            padding: 10px 20px;
            /* Adjust padding if needed */
        }
    </style>
@endsection

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
                    
                    <ul class="nav nav-custom-pills mb-3" id="pills-tab-custom" role="tablist">
                        <li class="nav-item ">
                            <a class="nav-link active " id="pills-home-tab" data-toggle="pill" href="#pills-home-custom-pill"
                                role="tab" aria-controls="pills-home" aria-selected="true"> {{ $order->payments_count ?? '' }} Premium Users Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="pills-profile-tab" data-toggle="pill" href="#pills-profile-custom-pill"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Free Users Orders</a>
                        </li>
                       
                    </ul>
                    <div class="tab-content mt-5" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="pills-home-custom-pill" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            @if($orders ?? '')
                            @foreach ($orders as $order)
                           
                                <div class="accordion" id="accordion{{ $order->id ?? '' }}">
                                    <div class="card">
                                        <div class="card-header" id="heading{{ $order->id ?? '' }}">
                                            <h2>
                                                @foreach ($profilePrefixs as $profilePrefix)
                                                @endforeach
                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapse{{ $order->id ?? '' }}" aria-expanded="false"
                                                    aria-controls="collapse{{ $order->id ?? '' }}">
                                                    <i class="mdi mdi-account-card-details"></i>
                                                    <span>{{ $order->name ?? '' }}({{ $profilePrefix->name ?? '' }}-{{ $order->id ?? '' }})
                                                        | {{ $order->mobiles ?? '30 Years' }} |
                                                        {{ $order->mobiles ?? "5'10'" }} |
                                                        {{ $order->email ?? '' }} | {{ $order->mobile ?? '' }} |
                                                        {{ $order->mobiles ?? 'Male' }} |
                                                        {{ $order->mobiles ?? 'Never Married' }}
                                                        | {{ $order->mobiles ?? 'Delhi' }} |</span>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapse{{ $order->id ?? '' }}" class="collapse"
                                            aria-labelledby="heading{{ $order->id ?? '' }}"
                                            data-parent="#accordion{{ $order->id ?? '' }}">
                                            <div class="card-body">
                                                <table id="productsTable" class="table table-hover table-product"
                                                    style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>Status</th>
                                                            <th>Mode</th>
                                                            <th>Amount</th>
                                                            <th>Offer</th>
                                                            <th>Plan</th>
                                                            <th>Start</th>
                                                            <th>End</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->payments as $payment)
                                                            <tr
                                                                @if ($payment->is_paid == 'Active') style="background-color: #6effbb" @endif>
                                                                <td class="py-0">
                                                                    {{ $payment->id ?? '' }} <img
                                                                        src="{{ asset('storage/admin/user-images/' . ($order->image ?? 'male-default.jpg')) }}"
                                                                        alt="Product Image">
                                                                </td>
                                                                <td>
                                                                    @if ($payment->is_paid == 'Active')
                                                                        Active
                                                                    @else
                                                                        InActive
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($payment->plan->razorpays->isNotEmpty())
                                                                        {{ $payment->plan->razorpays->first()->method ?? 'Null' }}
                                                                    @else
                                                                        Null
                                                                    @endif
                                                                </td>
                                                                <td>{{ $payment->plan->offer_price ?? '' }}</td>
                                                                <td>{{ $payment->plan->saving ?? '' }}</td>
                                                                <td>{{ $payment->plan->name ?? '' }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d-M-Y') ?? '' }}
                                                                </td>
                                                                <td>{{ \Carbon\Carbon::parse($payment->expiry_date)->format('d-M-Y') ?? '' }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                        </div>
                        <div class="tab-pane fade" id="pills-profile-custom-pill" role="tabpanel"
                            aria-labelledby="nav-profile-tab">
                            @if($freeUsersOrders ?? '')
                            @foreach ($freeUsersOrders as $freeUsersOrder)
                           <div class="accordion" id="accordion-freeUsersOrder{{ $freeUsersOrder->id  }}">
                                    <div class="card">
                                        <div class="card-header" id="heading-freeUsersOrder{{ $freeUsersOrder->id ?? '' }}">
                                            <h2>
                                                
                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapse-freeUsersOrder{{ $freeUsersOrder->id ?? '' }}" aria-expanded="false"
                                                    aria-controls="collapse-freeUsersOrder{{ $freeUsersOrder->id ?? '' }}">
                                                    <i class="mdi mdi-account-card-details"></i>
                                                    <span>{{ $freeUsersOrder->name ?? '' }}({{ $profilePrefix->name ?? '' }}-{{ $freeUsersOrder->id ?? '' }})
                                                        | {{ $freeUsersOrder->mobiles ?? '30 Years' }} |
                                                        {{ $freeUsersOrder->mobiles ?? "5'10'" }} |
                                                        {{ $freeUsersOrder->email ?? '' }} | {{ $freeUsersOrder->mobile ?? '' }} |
                                                        {{ $freeUsersOrder->mobiles ?? 'Male' }} |
                                                        {{ $freeUsersOrder->mobiles ?? 'Never Married' }}
                                                        | {{ $freeUsersOrder->mobiles ?? 'Delhi' }} |</span>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapse-freeUsersOrder{{ $freeUsersOrder->id ?? '' }}" class="collapse"
                                            aria-labelledby="heading-freeUsersOrder{{ $freeUsersOrder->id ?? '' }}"
                                            data-parent="#accordion-freeUsersOrder{{ $freeUsersOrder->id ?? '' }}">
                                            <div class="card-body">
                                                <table id="productsTable" class="table table-hover table-product"
                                                    style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>Status</th>
                                                            <th>Mode</th>
                                                            <th>Amount</th>
                                                            <th>Offer</th>
                                                            <th>Plan</th>
                                                            <th>Start</th>
                                                            <th>End</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                         @foreach ($freeUsersOrder->payments as $freepayment)
                                                            <tr
                                                               
                                                                @if ($freepayment->is_paid == 'Active') style="background-color: #6effbb" @endif>
                                                                <td class="py-0">
                                                                    {{ $freepayment->id ?? '' }} <img
                                                                        src="{{ asset('storage/admin/user-images/' . ($order->image ?? 'male-default.jpg')) }}"
                                                                        alt="Product Image">
                                                                </td>
                                                                <td>
                                                                    @if ($freepayment->is_paid == 'Active')
                                                                        Active
                                                                    @else
                                                                        InActive
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($freepayment->plan->razorpays->isNotEmpty())
                                                                        {{ $freepayment->plan->razorpays->first()->method ?? 'Null' }}
                                                                    @else
                                                                        Null
                                                                    @endif
                                                                </td>
                                                                <td>{{ $freepayment->plan->offer_price ?? '' }}</td>
                                                                <td>{{ $freepayment->plan->saving ?? '' }}</td>
                                                                <td>{{ $freepayment->plan->name ?? '' }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($freepayment->created_at)->format('d-M-Y') ?? '' }}
                                                                </td>
                                                                <td>{{ \Carbon\Carbon::parse($freepayment->expiry_date)->format('d-M-Y') ?? '' }}
                                                                </td>
                                                            </tr>
                                                       @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Table script --}}
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
    </body>
@endsection
