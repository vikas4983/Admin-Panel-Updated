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
        <form action="{{ route('paymentgateways.update', $paymentGateway->id) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="form-group col-lg-12">
                    <label>Razorpay Key</label>
                    <input type="text" class="form-control" name="razorpay_key"
                        placeholder="Enter Razorpay Key"
                        value="{{ old('razorpay_key', $paymentGateway->razorpay_key) }}">
                    <input type="hidden" name="name" value="Razorpay">
                </div>
                <div class="form-group col-lg-12">
                    <label>Status</label>
                    <select name="status" class="form-control">
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
