@if ($inActiveUsers ?? '')
    @foreach ($inActiveUsers as $inActiveUser)
        <div class="col-lg-4 col-xl-4 col-xxl-4">
            <div class="card card-default mt-7">
                <div class="card-body">
                    <a class="d-block mb-2" href="javascript:void(0)" data-toggle="modal"
                        data-target="#modal-contact-{{ $inActiveUser->id }}">
                        <div class="image mb-3 d-inline-flex mt-n8">
                            <img src="{{ asset('storage/admin/user-images/' . ($inActiveUser->image ?? 'male-default.jpg')) }}"
                                class="img-fluid rounded-circle d-inline-block" alt="Avatar Image" width="100px"
                                height="100px">
                        </div>
                        <h5 class="card-title">{{ $inActiveUser->name ?? '' }} ({{ $inActiveUser->id }})
                            <i class="mdi mdi-security"></i>
                            @if ($inActiveUser->status == 'Active')
                                <i class="mdi mdi-eye" style="color:rgb(13, 227, 6)"></i>
                            @else
                                <i class="mdi mdi-eye" style="color:rgb(217, 34, 34)"></i>
                            @endif
                            @if ($inActiveUser->payments->isNotEmpty() && $inActiveUser->payments->last()->is_paid == 1)
                                <i class="mdi mdi-chess-queen" style="color:#9E6DE2"></i>
                            @endif
                        </h5>
                    </a>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <ul class="list-unstyled d-inline-block mb-5">
                                    <li class="d-flex mb-1">
                                        <i class="mdi mdi-gmail mr-1"></i>
                                        <span>{{ Str::limit($inActiveUser->email ?? '', 20) }}</span>
                                    </li>
                                    <li class="d-flex">
                                        <i class="mdi mdi-phone mr-1"></i>
                                        <span>8770745851</span>
                                    </li>
                                    <li class="d-flex mb-1">
                                        <i class="mdi mdi-led-strip mr-1"></i>
                                        <span>5'10" (120cm)</span>
                                    </li>
                                    <li class="d-flex">
                                        <i class="mdi mdi-heart-half-full mr-1"></i>
                                        <span>Never Married</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul class="list-unstyled d-inline-block mb-5">
                                    <li class="d-flex mb-1">
                                        <i class="mdi mdi-human-male mr-1"></i>
                                        <span>Male</span>
                                    </li>
                                    <li class="d-flex">
                                        <i class="mdi mdi-calendar mr-1"></i>
                                        <span>26 Apr 1994 (29 Years)</span>
                                    </li>
                                    <li class="d-flex mb-1">
                                        <i class="mdi mdi-hinduism mr-1"></i>
                                        <span>Hindu</span>
                                    </li>
                                    <li class="d-flex">
                                        <i class="mdi mdi-star-box mr-1"></i>
                                        <span>Agrawal</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unique Contact Modal -->
        <div class="modal fade" id="modal-contact-{{ $inActiveUser->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header justify-content-end border-bottom-0">
                        <button type="button" class="btn-edit-icon" data-dismiss="modal" aria-label="Close">
                            <i class="mdi mdi-pencil"></i>
                        </button>
                        <div class="dropdown">
                            <button class="btn-dots-icon" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                @if ($inActiveUser->payments->isNotEmpty())
                                    @php
                                        $activePlan = $inActiveUser->payments->last();
                                        $expiryDate = \Carbon\Carbon::parse($activePlan->expiry_date);
                                    @endphp

                                    @if ($expiryDate->isFuture())
                                        <button type="button" class="dropdown-item" data-toggle="modal"
                                            data-target="#exampleModal-editPlan{{ $inActiveUser->id }}">
                                            <i class="mdi mdi-wallet-membership"></i> Edit Plan
                                        </button>
                                    @else
                                        <button type="button" class="dropdown-item" data-toggle="modal"
                                            data-target="#exampleModal-upgradePlan{{ $inActiveUser->id }}">
                                            <i class="mdi mdi-wallet-membership"></i> Upgrade Plan
                                        </button>
                                    @endif
                                @else
                                    <button type="button" class="dropdown-item" data-toggle="modal"
                                        data-target="#exampleModal-upgradePlan{{ $inActiveUser->id }}">
                                        <i class="mdi mdi-wallet-membership"></i> Upgrade Plan
                                    </button>
                                @endif


                                <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                                <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                            </div>
                        </div>
                        <button type="button" class="btn-close-icon" data-dismiss="modal" aria-label="Close">
                            <i class="mdi mdi-close"></i>
                        </button>
                    </div>

                    {{-- <!-- Edit Plan Modal -->
                    @if (!empty($inActiveUser))
                            <x-edit-plan-component :inActiveUser="$inActiveUser"  />
                        @endif
                         <!-- Upgrade Plan Modal -->
                    @if (!empty($inActiveUser))
                            <x-upgrade-plan-component :inActiveUser="$inActiveUser"  />
                        @endif --}}

                    <div class="modal-body pt-0">
                        <div class="row no-gutters">
                            <div class="col-md-6">
                                <div class="profile-content-left px-4">
                                    <div class="card text-center px-0 border-0">
                                        <div class="card-img mx-auto">
                                            <img class="rounded-circle"
                                                src="{{ asset('storage/admin/user-images/' . ($inActiveUser->image ?? 'male-default.jpg')) }}"
                                                alt="user image">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="py-2">{{ $inActiveUser->name ?? '' }}</h4>
                                            <p>{{ $inActiveUser->email ?? '' }}</p>
                                            <a class="btn btn-primary btn-pill btn-lg my-4"
                                                href="javascript:void(0)">Follow</a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between ">
                                        <div class="text-center pb-4">
                                            <h6 class="pb-2">1503</h6>
                                            <p>Request</p>
                                        </div>
                                        <div class="text-center pb-4">
                                            <h6 class="pb-2">2905</h6>
                                            <p>Accepted</p>
                                        </div>
                                        <div class="text-center pb-4">
                                            <h6 class="pb-2">1200</h6>
                                            <p>Sent</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-info px-4">
                                    <h4 class="mb-1">Basic Details</h4>
                                    <div class="row">
                                        <div class="col mt-3">
                                            <ul class="list-unstyled d-inline-block mb-5">

                                                <li class="d-flex mb-1">
                                                    <i class="mdi mdi-account-clock mr-1"></i>
                                                    <span>
                                                        <h6>
                                                            {{ isset($inActiveUser->created_at) ? \Carbon\Carbon::parse($inActiveUser->created_at)->isoFormat('DD-MMM-YYYY hh:mma') : '' }}
                                                        </h6>
                                                    </span>
                                                </li>
                                                <li class="d-flex mt-2">
                                                    <i class="mdi mdi-heart-half mr-1"></i>
                                                    <span>
                                                        <h6>Never Married</h6>
                                                    </span>
                                                </li>
                                                <li class="d-flex mt-2">
                                                    <i class="mdi mdi-calendar mr-1"></i>
                                                    <span>
                                                        <h6>26 apr 1994</h6>
                                                    </span>
                                                </li>
                                                <li class="d-flex mt-2">
                                                    <i class="mdi mdi-ruler mr-1"></i>
                                                    <h6><span>4ft 10in - 147cm</span></h6>
                                                </li>
                                                <li class="d-flex mt-2">
                                                    <i class="mdi mdi-book mr-1"></i>
                                                    <span>
                                                        <h6>BA</h6>
                                                    </span>
                                                </li>
                                                {{-- <li class="d-flex">
                                                                            <i class="mdi mdi-star-box mr-1"></i>
                                                                            <span> Manager</span>
                                                                        </li> --}}
                                            </ul>

                                        </div>

                                        <div class="col mt-3">
                                            <ul class="list-unstyled d-inline-block mb-5">
                                                <li class="d-flex mb-1">
                                                    <i class="mdi mdi-human-male mr-1 "></i>
                                                    <span>
                                                        <h6>Male</h6>
                                                    </span>
                                                </li>
                                                <li class="d-flex mt-2">
                                                    <i class="mdi mdi-earth mr-1"></i>
                                                    <span>
                                                        <h6>India</h6>
                                                    </span>
                                                </li>
                                                <li class="d-flex mt-2">
                                                    <i class="mdi mdi-city mr-1"></i>
                                                    <span>
                                                        <h6>Delhi</h6>
                                                    </span>
                                                </li>
                                                <li class="d-flex mt-2">
                                                    <i class="mdi mdi-hinduism mr-1"></i>
                                                    <span>
                                                        <h6>Hindu</h6>
                                                    </span>
                                                </li>
                                                <li class="d-flex mt-2">
                                                    <i class="mdi mdi-star-box mr-1"></i>
                                                    <span>
                                                        <h6>Agrawal</h6>
                                                    </span>
                                                </li>

                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                @if ($inActiveUser->payments->isNotEmpty())
                                    @php
                                        $activePlan = $inActiveUser->payments->last();
                                        $expiryDate = \Carbon\Carbon::parse($activePlan->expiry_date);
                                    @endphp

                                    @if ($expiryDate->isFuture())
                                        <div class="contact-info px-4">
                                            <h4 class="mb-1">Current Plan</h4>
                                            <div class="row">
                                                <div class="col mt-3">
                                                    <ul class="list-unstyled d-inline-block mb-5">
                                                        <li class="d-flex mb-1">
                                                            <i class="mdi mdi-chess-queen mr-1"></i>
                                                            <span>
                                                                <h6>Name</h6>
                                                            </span>
                                                        </li>
                                                        <li class="d-flex mt-2">
                                                            <i class="mdi mdi-contacts mr-1"></i>
                                                            <span>
                                                                <h6>Left Contact</h6>
                                                            </span>
                                                        </li>
                                                        <li class="d-flex mt-2">
                                                            <i class="mdi mdi-calendar-clock mr-1"></i>
                                                            <span>
                                                                <h6>Expiry Date</h6>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="col mt-3">
                                                    <ul class="list-unstyled d-inline-block mb-5">
                                                        <li class="d-flex mb-1">
                                                            <span>
                                                                <h6>{{ $activePlan->plan->name ?? 'No plan info' }}
                                                                </h6>
                                                            </span>
                                                        </li>
                                                        <li class="d-flex mt-2">
                                                            <span>
                                                                <h6>{{ $activePlan->contact ?? 'No contact info' }}
                                                                </h6>
                                                            </span>
                                                        </li>
                                                        <li class="d-flex mt-2">
                                                            <span>
                                                                {{ $activePlan->expiry_date ? $expiryDate->format('d-M-Y') : '' }}
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary"
                                                onclick="alert('Activate this user first');" data-toggle="modal"
                                                data-target="#exampleModal-upgradePlan{{ $inActiveUser->id }}">
                                                <i class="mdi mdi-wallet-membership"></i> Upgrade Plan
                                            </button>
                                        </div>
                                    @endif
                                @else
                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary"
                                            onclick="alert('Activate this user first');" data-toggle="modal"
                                            data-target="#exampleModal-upgradePlan{{ $inActiveUser->id }}">
                                            <i class="mdi mdi-wallet-membership"></i> Upgrade Plan
                                        </button>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
