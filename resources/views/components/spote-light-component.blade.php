<div class="modal fade" id="spote-light{{$paidUsers}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h5 class="modal-title" id="exampleModalLabel">Spote Light</h5>
                <button type="button" class="close position-absolute" style="right: 1rem;" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('spotelights.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="user_id" value="{{ $paidUsers->id }}">
                    <div class="form-group">
                        <label>Spote Light Duration</label>
                        <select name="plan_id" class="form-control col-lg-12" required>
                            <option value="" disabled selected>Select One</option>
                            <option value="10">10 Days</option>
                            <option value="20">20 Days</option>
                            <option value="30">30 Days</option>
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
