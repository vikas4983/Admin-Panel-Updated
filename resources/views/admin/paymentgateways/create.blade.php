@extends('layouts.auth')
@section('title', 'Payment Gateway - Create | Admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('paymentgateways.index') }}">Site Config</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Site Setting</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <!-- First Card -->
                <div class="col-lg-4">
                    <div class="card card-default">
                        <div class="card-body">
                            <h3 class="text-center mr-3" style="color:white;background-color: #1364F1">Razorpay</h3>
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
                            <form action="{{ route('paymentgateways.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label>Razorpay Key</label>
                                        <input type="text" class="form-control" name="razorpay_key"
                                            placeholder="Enter Razorpay Key"
                                            value="{{ old('razorpay_key') }}" required>
                                            <input type="hidden" name="name" value="Razorpay">
                                    </div>
                                   <div class="form-group col-lg-12">
                                        <label>Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Deactive</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Second Card -->
                <div class="col-lg-4">
                    <div class="card card-default">
                        <div class="card-body">
                             <h3 class="text-center mr-3" style="color:white;background-color: #18B08A">Payumoney</h3>
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
                            <form action="{{ route('paymentgateways.store') }}" method="post">
                                @csrf
                                 <input type="hidden" name="name" value="PayUmoney">
                                
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label>Merchant Key</label>
                                        <input type="text" class="form-control" name="merchant_key"
                                            placeholder="Enter Merchant Key "
                                            value="{{ old('merchant_key') }}" required>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Salt</label>
                                        <input type="text" class="form-control" name="salt"
                                            placeholder="Enter Salt "
                                            value="{{ old('salt') }}" required>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Merchant Id</label>
                                        <input type="text" class="form-control" name="merchant_id"
                                            placeholder="Enter Merchant Id "
                                            value="{{ old('merchant_id') }}" required>
                                    </div>
                                   
                                    <div class="form-group col-lg-12">
                                        <label>Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Deactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Third Card -->
                <div class="col-lg-4">
                    <div class="card card-default">
                        <div class="card-body">
                             <h3 class="text-center mr-3" style="color:white;background-color: #17A6E0">Bank</h3>
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
                            <form action="{{ route('paymentgateways.store') }}" method="post">
                                @csrf
                                 <input type="hidden" name="name" value="Bank">
                                
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label>Bank Name</label>
                                        <input type="text" class="form-control" name="bank_name"
                                            placeholder="Enter Bank Name "
                                            value="{{ old('bank_name') }}" required>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Bank Account Name</label>
                                        <input type="text" class="form-control" name="account_name"
                                            placeholder="Enter Account Name "
                                            value="{{ old('account_name') }}" required>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Bank Account Number</label>
                                        <input type="text" class="form-control" name="bank_account_number"
                                            placeholder="Enter Bank Account Number "
                                            value="{{ old('bank_account_number') }}" required>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Bank IFSC Code</label>
                                        <input type="text" class="form-control" name="bank_ifsc"
                                            placeholder="Enter Bank IFSC Code "
                                            value="{{ old('bank_ifsc') }}" required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Account Type</label>
                                        <input type="text" class="form-control" name="bank_account_type"
                                            placeholder="Enter Account Type "
                                            value="{{ old('bank_account_type') }}" required>
                                    </div>
                                   <div class="form-group col-lg-6">
                                        <label>Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Deactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
