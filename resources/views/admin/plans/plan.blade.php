@extends('layouts.auth')
@section('content')
    {{-- <style>
    .razorpay-payment-button{
        cursor: pointer;
        border-radius: 30px;
        text-transform: uppercase;
        box-shadow: none !important;
        color: #9e6de0;
        border-color: #9e6de0;

        display: inline-block;
    font-weight: 400;
    text-align: center;
    vertical-align: middle;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    font-size: 0.9375rem;
    line-height: 1.5;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        -webkit-appearance: button;
        background: transparent;
    }
</style> --}}
    <div class="content-wrapper">
        <div class="content">
            {{-- <div class="card card-default card-profile">

                <div class="card-header-bg" style="background-image:url(assets/img/user/user-bg-01.jpg)"></div>

                <div class="card-body card-profile-body">

                    <div class="profile-avata">
                        <img class="rounded-circle" src="images/user/user-md-01.jpg" alt="Avata Image">
                        <a class="h5 d-block mt-3 mb-2" href="#">Albrecht Straub</a>
                        <a class="d-block text-color" href="#">albercht@example.com</a>
                    </div>

                    <ul class="nav nav-profile-follow">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="h5 d-block">1503</span>
                                <span class="text-color d-block">Friends</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="h5 d-block">2905</span>
                                <span class="text-color d-block">Followers</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="h5 d-block">1200</span>
                                <span class="text-color d-block">Following</span>
                            </a>
                        </li>

                    </ul>

                    <div class="profile-button">
                        <a class="btn btn-primary btn-pill" href="user-planing-settings.html">Upgrade Plan</a>
                    </div>

                </div>

                <div class="card-footer card-profile-footer">
                    <ul class="nav nav-border-top justify-content-center">
                        {{-- <li class="nav-item">
        <a class="nav-link" href="user-profile.html">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user-activities.html">Activities</a>
      </li> --}}
            {{-- <li class="nav-item">
                            <a class="nav-link active" href="user-profile-settings.html"><i
                                    class="mdi mdi-currency-usd mr-1"></i>Planing</a>
                        </li>

                    </ul>
                </div>

            </div> --}}

            <div class="row">
                <div class="col-xl-3">
                    <!-- Settings -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h2>Settings</h2>
                        </div>

                        <div class="card-body pt-0">

                            <ul class="nav nav-settings">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('myprofile.index') }}">
                                        <i class="mdi mdi-account-outline mr-1"></i> Profile
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
            <a class="nav-link" href="user-account-settings.html">
              <i class="mdi mdi-settings-outline mr-1"></i> Account
            </a>
          </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link active" href="user-planing-settings.html">
                                        <i class="mdi mdi-currency-usd mr-1"></i> Planing
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
            <a class="nav-link" href="user-billing.html">
              <i class="mdi mdi-set-top-box mr-1"></i> Billing
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user-notify-settings.html">
              <i class="mdi mdi-bell-outline mr-1"></i> Notifications
            </a>
          </li> --}}
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="col-xl-9">
                    <!-- Choose Your Plan -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h2 class="mb-5">Choose Your Plan</h2>
                        </div>

                        <div class="card-body">
                            <div class="row justify-content-center">
                                @foreach ($plans as $plan)
                                    {{-- @dd( \App\Models\Payment::latest('created_at', 'desc')->get()) --}}
                                    <div class="col-lg-6 col-xl-4">
                                        <div class="card card-default">
                                            @if ($latestPayment ?? '')
                                                @if ($latestPayment->plan_id === $plan->id)
                                                    @if ($expiryDate > $currentDate)
                                                        <div class="btn btn-primary">
                                                            Your Active plan
                                                        </div>
                                                    @else
                                                        <!-- Plan is not active -->
                                                    @endif
                                                @endif
                                            @endif
                                            <div class="card-header align-items-center flex-column">
                                                <h5 class="h4 mb-2"><i
                                                        class="mdi mdi-chess-queen text-primary"></i>{{ $plan->name }}
                                                </h5>

                                                <p class="text-right">For - {{ $plan->duration }} Days</p>
                                                <p class="text-center"><strong style="color: rgb(255, 99, 71)">
                                                        {{ $plan->offer }} Off </strong>
                                                    ₹{{ $plan->price }}</p>
                                            </div>
                                            <div class="card-body d-flex flex-column" style="min-height: 350px">
                                                <ul class="d-flex flex-column align-items-center">
                                                    <li class="h2 text-primary mb-5">
                                                        ₹{{ number_format($plan->offer_price, 0, '.', ',') }}
                                                        <p class="text-center h6 " style="color: rgb(138,154,195)">
                                                            ₹{{ number_format($plan->per_month, 0, '.', ',') }} Per Day</p>
                                                    </li>
                                                </ul>

                                                <ul>
                                                    <li class=" text-center mb-3 text-dark font-weight-bold">
                                                        <i class="mdi mdi-phone text-primary"></i>
                                                        View Contacts
                                                        <p class=" h4 d-flex flex-column align-items-center"><strong
                                                                style="color: rgb(255, 99, 71)">
                                                                {{ $plan->allow_contact }} </strong></p>
                                                    </li>
                                                    <li class=" text-center mb-3 text-dark font-weight-bold">
                                                        <i class="mdi mdi-message-text text-primary"></i>
                                                        Send Messages
                                                        <p class=" h4 d-flex flex-column align-items-center"><strong
                                                                style="color: rgb(255, 99, 71)">
                                                                {{ $plan->message }} </strong></p>

                                                    </li>
                                                    <li class=" text-center mb-3 text-dark font-weight-bold">
                                                        <i class="mdi mdi-chat text-primary"></i>
                                                        Unlimited Chat
                                                        <p class=" h4 d-flex flex-column align-items-center"><strong
                                                                style="color: rgb(255, 99, 71)">
                                                                {{ $plan->chat }} </strong></p>
                                                    </li>
                                                    <li class=" text-center mb-3 text-dark font-weight-bold">
                                                        <i class="mdi mdi-video text-primary"></i>
                                                        Video Call
                                                        <p class=" h4 d-flex flex-column align-items-center"><strong
                                                                style="color: rgb(255, 99, 71)">
                                                                {{ $plan->video_call }} </strong></p>
                                                    </li>
                                                </ul>
                                                <div class="d-flex justify-content-center mt-auto">
                                                    {{-- <button type="button" class="btn btn-outline-primary btn-pill"
                                                        data-toggle="modal" data-target="#{{ $plan->id }}">
                                            Continue
                                            </button> --}}
                                                    <form action="{{ route('razorpay.payment.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="plan_id" id="plan_id"
                                                            value="{{ $plan->id }}">
                                                        <input type="hidden" name="admin_id" id="admin_id"
                                                            value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="order_id" id="order_id"
                                                            value="{{ rand(1000, 99999) }}">
                                                        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}"
                                                            data-amount="{{ $plan->offer_price * 100 ?? '' }}" data-prefill.contact="{{ $admin->contact ?? '8770745845' }}"
                                                            data-buttontext="Pay {{ $plan->offer_price }} INR" data-name="Mangal Mandap" data-description="Rozerpay"
                                                            data-image="https://mangalmandap.com/images/mangal_logo.jpg" data-prefill.name={{ $admin->name ?? '' }}
                                                            data-prefill.email={{ $admin->email ?? '' }} data-theme.color="#ff7529"></script>
                                                    </form>
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            // Wait for the document to be ready

                                                            // Get the element
                                                            var elements = document.getElementsByClassName('razorpay-payment-button');
                                                            console.log("DOMContentLoaded razorpay-payment-button: ", elements);

                                                            // Replace the source class with the target class
                                                            if (elements) {
                                                                for (var i = 0; i < elements.length; i++) {
                                                                    var element = elements[i];

                                                                    // Replace the source class with the target classes
                                                                    if (element) {
                                                                        element.classList.remove('razorpay-payment-button');
                                                                        element.classList.add('btn', 'btn-outline-primary', 'btn-pill');
                                                                    }
                                                                }
                                                            }


                                                        });
                                                    </script>


                                                    <div class="modal fade" id="{{ $plan->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalFormTitle"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: #9E6DE0 ">
                                                                    <h5 class="modal-title" id="exampleModalFormTitle">
                                                                        <p style="color: rgb(255, 255, 255)">Order Summary
                                                                        </p>
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true"
                                                                            style="color: rgb(255, 250, 249)">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div
                                                                        style="display: flex; justify-content: space-between; align-items: center;  padding: 10px; margin-bottom: 10px;">
                                                                        <div style="flex-grow: 1;">
                                                                            <h5><strong>{{ $plan->name }}
                                                                                    ({{ $plan->duration }}
                                                                                    Days)
                                                                                </strong></h5>
                                                                            <p>
                                                                            <h5 style="color: green">Saving
                                                                                ({{ $plan->offer }}% Off)
                                                                            </h5>
                                                                            </p>
                                                                        </div>
                                                                        <div style="margin-left: 10px; color:black">
                                                                            <p>
                                                                            <h5>₹{{ number_format($plan->price, 0, '.', ',') }}
                                                                            </h5>
                                                                            </p>
                                                                            <p>
                                                                            <h5>-₹{{ number_format($plan->saving, 0, '.', ',') }}
                                                                            </h5>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div
                                                                        style="display: flex; justify-content: space-between; align-items: center;  padding: 10px; margin-bottom: 10px;">
                                                                        <div style="flex-grow: 1;">
                                                                            <h5><strong style="color: #9E6DE0">Total Amount
                                                                                </strong></h5>
                                                                            {{-- <p style="color: rgb(64, 158, 64)">(₹{{ $plan->saving }})</p> --}}
                                                                        </div>
                                                                        <div style="margin-left: 10px; color:black">
                                                                            <h5> ₹{{ number_format($plan->offer_price, 0, '.', ',') }}
                                                                            </h5>
                                                                        </div>


                                                                    </div>


                                                                    <i class="mdi mdi-emoticon-happy"
                                                                        style="color: #9E6DE0"></i> You are saving
                                                                    <span style="color: green">
                                                                        ₹{{ number_format($plan->saving, 0, '.', ',') }}</span>
                                                                    on this order

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ url('admin/razorpay-payment') }}"
                                                                        method="get">
                                                                        @csrf

                                                                        {{-- <input type="hidden" name="admin_id"
                                                                            value="{{ Auth::user()->id ?? '' }}"> --}}
                                                                        {{-- --}}
                                                                        <input type="hidden" name="plan_id"
                                                                            value="{{ $plan->id ?? '' }}">

                                                                        <button type="submit "
                                                                            class="btn btn-primary btn-pill">
                                                                            Continue
                                                                        </button>
                                                                    </form>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- <a href="#" class="btn btn-outline-primary btn-pill">Select
                                                        plan</a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                        </div>

                    </div>
                </div>

            </div>
        @endsection
