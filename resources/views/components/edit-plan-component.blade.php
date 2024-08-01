<div class="modal fade" id="exampleModal-editPlan{{ $paidUser->user->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h5 class="modal-title" id="exampleModalLabel">Edit Plan</h5>
                <button type="button" class="close position-absolute" style="right: 1rem;" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            {{-- @dd($paidUser) --}}
            <div class="modal-body">
                <form action="{{ route('payments.update', $paidUser->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="user_id" value="{{ $paidUser->user->id }}">
                    <div class="form-group">
                        <label>Select Plan</label>
                        <select name="plan_id" class="form-control col-lg-12" required>
                            <option value="" disabled selected>Select a Plan</option>
                            <option value="1">Silver</option>
                            <option value="2">Gold</option>
                            <option value="3">Diamond</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
