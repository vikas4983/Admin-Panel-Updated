@extends('layouts.auth')
@section('title', 'Approvals | Admin')
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
                            <li class="breadcrumb-item active" aria-current="page">Approval</li>
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
                    @if (count($approvals) > 0)
                        {{-- <table class="table " id="menus" class="display nowrap" width="100%"> --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Review</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Account</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Matri Id</th>


                                    {{-- <th scope="col">#</th> --}}
                                    {{-- <th scope="col"><input type="checkbox" id="allCheckbox"></th> --}}
                                    {{-- <th scope="col">Action</th> --}}

                                    {{-- <th scope="col">About Me</th>
                                    <th scope="col">About Education</th>
                                    <th scope="col">About Occupation</th>
                                    <th scope="col">About Family</th>
                                    <th scope="col">Read Carefully</th>
                                    <th scope="col">Success Story</th>
                                    <th scope="col">Img1</th>
                                    <th scope="col">Img2</th>
                                    <th scope="col">Img3</th>
                                    <th scope="col">Img4</th>
                                    <th scope="col">Img5</th>
                                    <th scope="col">Img6</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = ($approvals->currentPage() - 1) * $approvals->perPage() + 1;
                                @endphp

                                @foreach ($approvals as $approval)
                                    <tr>
                                        <td>
                                            <span class="mr-1 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle"
                                                data-toggle="modal" data-target="#exampleModal">
                                                <i class="fa fa-eye"></i>
                                            </span>

                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header d-flex justify-content-center">
                                                            <h5 class="modal-title" id="exampleModalLabel">Approvals</h5>
                                                            <button type="button" class="close position-absolute"
                                                                style="right: 1rem;" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container">

                                                            </div>
                                                        </div>


                                                        <form action="{{ route('approvals.update', $approval ?? '') }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="container">
                                                                <div class="mb-3">
                                                                    <label
                                                                        class="switch switch-text switch-primary switch-pill form-control-label">
                                                                        <input type="checkbox"
                                                                            class="switch-input form-check-input"
                                                                            value="off">
                                                                        <span class="switch-label" data-on="All"
                                                                            data-off="Off"></span>
                                                                        <span class="switch-handle"></span>
                                                                    </label>
                                                                </div>
                                                                <div>
                                                                    <span>
                                                                        <label
                                                                            class="switch switch-icon switch-primary form-control-label">
                                                                            <input type="checkbox"
                                                                                class="switch-input form-check-input individual-switch"
                                                                                value="{{'123'}}" name="about_me">
                                                                            <span class="switch-label"></span>
                                                                            <span class="switch-handle"></span>
                                                                        </label>
                                                                        <label class="ml-2 ">About Me</label>
                                                                    </span>
                                                                </div>
                                                                <div>
                                                                    <textarea class="col-lg-12 mb-3"  ></textarea>
                                                                </div>
                                                                <div>
                                                                    <span>
                                                                        <label
                                                                            class="switch switch-icon switch-primary form-control-label">
                                                                            <input type="checkbox"
                                                                                class="switch-input form-check-input individual-switch"
                                                                                value="off">
                                                                            <span class="switch-label"></span>
                                                                            <span class="switch-handle"></span>
                                                                        </label>
                                                                        <label class="ml-2">About Education</label>
                                                                    </span>
                                                                </div>
                                                                <div>
                                                                    <textarea class="col-lg-12 mb-3"  ></textarea>
                                                                </div>
                                                                <div>
                                                                    <span>
                                                                        <label
                                                                            class="switch switch-icon switch-primary form-control-label">
                                                                            <input type="checkbox"
                                                                                class="switch-input form-check-input individual-switch"
                                                                                value="off">
                                                                            <span class="switch-label"></span>
                                                                            <span class="switch-handle"></span>
                                                                        </label>
                                                                        <label class="ml-2">About Occupation</label>
                                                                    </span>
                                                                </div>
                                                                <div>
                                                                    <textarea class="col-lg-12 mb-3"  name="aboutMe"></textarea>
                                                                </div>
                                                                <div>
                                                                    <span>
                                                                        <label
                                                                            class="switch switch-icon switch-primary form-control-label">
                                                                            <input type="checkbox"
                                                                                class="switch-input form-check-input individual-switch"
                                                                                value="off">
                                                                            <span class="switch-label"></span>
                                                                            <span class="switch-handle"></span>
                                                                        </label>
                                                                        <label class="ml-2 ">About Family</label>
                                                                    </span>
                                                                </div>
                                                                <div>
                                                                    <textarea class="col-lg-12 mb-3"  name="aboutMe"></textarea>
                                                                </div>

                                                                <div>
                                                                    <span>
                                                                        <label
                                                                            class="switch switch-icon switch-primary form-control-label">
                                                                            <input type="checkbox"
                                                                                class="switch-input form-check-input individual-switch"
                                                                                value="off">
                                                                            <span class="switch-label"></span>
                                                                            <span class="switch-handle"></span>
                                                                        </label>
                                                                        <label class="ml-2">Read Carefully</label>
                                                                    </span>
                                                                </div>
                                                                <div>
                                                                    <textarea class="col-lg-12 mb-3"  name="aboutMe"></textarea>
                                                                </div>
                                                                <div>
                                                                    <span>
                                                                        <label
                                                                            class="switch switch-icon switch-primary form-control-label">
                                                                            <input type="checkbox"
                                                                                class="switch-input form-check-input individual-switch"
                                                                                value="off">
                                                                            <span class="switch-label"></span>
                                                                            <span class="switch-handle"></span>
                                                                        </label>
                                                                        <label class="ml-2">Success Story</label>
                                                                    </span>
                                                                </div>
                                                                @foreach ($approval->user->successStories as $successStory)
                                                                    
                                                                    <div>
                                                                        <div class="col-md-4 mb-3">
                                                                            <div class="card">
                                                                                <div class="container">
                                                                                    <div>
                                                                                        <h3 style="color:#9E6DE0">
                                                                                            {{ $successStory->groom_name ?? '' }}
                                                                                            &
                                                                                            {{ $successStory->bride_name ?? '' }}
                                                                                        </h3>
                                                                                    </div>
                                                                                    <div> <i
                                                                                            class="mdi mdi-calendar-heart"></i>
                                                                                        {{ $successStory->wedding_date ?? '' }}
                                                                                    </div>
                                                                                </div>

                                                                                @if ($successStory->status == 'Active' ?? '')
                                                                                    <div class="card-img-top"
                                                                                        style="border-top-left-radius: 2px; border-top-right-radius: 2px; background-color: #0ACB8E; height: 5px;">
                                                                                    </div>
                                                                                @else
                                                                                    <div class="card-img-top"
                                                                                        style="border-top-left-radius: 2px; border-top-right-radius: 2px; background-color: #ec0c0c; height: 5px;">
                                                                                    </div>
                                                                                @endif

                                                                                <img class="card-img-top"
                                                                                    src="{{ asset('storage/admin/successStory/' . ($successStory ? $successStory->wedding_image : '')) }}"
                                                                                    alt="Success Story Image">
                                                                                <div class="card-body">
                                                                                    <!-- Apply text-center class here -->
                                                                                    {{-- <h5 class="card-title">Card Title</h5> --}}
                                                                                    <p class="card-text pb-3">
                                                                                        {{ $successStory->description ?? '' }}
                                                                                    <p>

                                                                                    {{-- <div
                                                                                        class="d-flex justify-content-center">
                                                                                        <a href="{{ route('successStories.edit', $successStory->id) }}"
                                                                                            class="mr-1 mt-5 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle"><i
                                                                                                class="fa fa-edit"></i></a>
                                                                                        <form
                                                                                            action="{{ route('successStories.destroy', $successStory->id) }}"
                                                                                            method="POST" class="mt-1">
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                            <button type="submit"
                                                                                                onclick="DeleteFunction();"
                                                                                                class="mr-1 mt-5 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle"><i
                                                                                                    class="fa fa-trash"
                                                                                                    style="color: red"></i></button>
                                                                                        </form>
                                                                                    </div> --}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach


                                                            </div>
                                                            <div class="text-center mb-3">
                                                                <button type="submit"
                                                                    class="btn btn-lg btn-outline-primary">Submit</button>
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
                                        <td> <x-status-component :status="$approval->status" />{{ $approval->user->name }}</td>
                                        <td>{{ $planStatus }}</td>
                                        <td>{{ $approval->user->created_at }}</td>
                                        @foreach ($profilePrefixes as $profilePrefixe )
                                            <td>
                                                {{$profilePrefixe->name}}
                                            </td>
                                        @endforeach




                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <span>{{ $approvals->links() }}</span>

                        </div>
                    @else()
                        <h3 class="text-center text-danger">No Approvals found</h3>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <script></script>
@endsection
