<div class="modal fade" id="exampleModal-forgot-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModal-forgot-password">Forgot Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="position: absolute; right: 1rem;">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @if (isset($success))
                    <div class="alert alert-success mt-3">
                        {{ $success }}
                    </div>
                @endif
                {{-- abc d --}}
                <div class="modal-body">
                    <form action="{{ url('forgot-password') }}" method="post" id="otp-form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 mb-4">
                                <label for="mobile-email">Mobile No. / Email ID</label>
                                <input type="text" id="otp-input" name="mobile" value="{{ old('mobile') }}"
                                    class="form-control col-lg-12" id="mobile" aria-describedby="mobileHelp"
                                    placeholder="Enter Mobile Number Or Email">
                                <span id="error-message-input" style="color: red; display: none;">Enter 10 digit
                                    Number.</span>
                                <span id="error-message" style="color: red; display: none;">Enter 10 digit Valid
                                    Number.</span>
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-center w-100">
                                <button type="submit" class="btn btn-primary btn-pill mb-4">Send OTP</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>