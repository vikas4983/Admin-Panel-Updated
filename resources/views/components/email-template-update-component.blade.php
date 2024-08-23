<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Custom width and height for the modal */
        .modal-dialog.custom-modal {
          max-width: 60%; /* Adjust the width as needed */
          width: 60%;
          max-height: 90vh; /* Adjust the height as needed */
        }
      
        .modal-content {
          height: 100%;
        }
      
        .modal-body {
          overflow-y: auto;
          max-height: calc(100% - 120px); /* Adjust the body height */
        }
      </style>
      
</head>
<body>
    <div class="modal fade" id="emailTemplateUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
        <div class="modal-dialog custom-modal" role="document">
          <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title" id="exampleModalFormTitle">Update Email Template</h5>
                <button type="button" class="close position-absolute" style="right: 15px;" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
            <div class="modal-body mt-5">
              <form action="{{ route('emailTemplates.update', $emailTemplate->id) }}" method="post">
                @csrf
                <div class="row">
                  <div class="form-group col-lg-3">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Email Template Name" value="{{ old('name', $emailTemplate->name ?? '') }}" required>

                  </div>
                  <div class="form-group col-lg-3">
                    <label>Subject</label>
                    <input type="text" class="form-control" name="subject" placeholder="Enter Subject" value="{{ old('subject',$emailTemplate->subject ?? '')   }}" required>
                  </div>
                  <div class="form-group col-lg-3">
                    <label>Action</label>
                    <select name="action" class="form-control">
                      <option value="1" {{ old('action', $emailTemplate->action) == 'Admin' ? 'selected' : '' }}>Admin</option>
                      <option value="0" {{ old('action', $emailTemplate->action) == 'User' ? 'selected' : '' }}>User</option>
                    </select>
                  </div>
                  
                  <div class="form-group col-lg-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="1" {{ old('status',$emailTemplate->status) == 'Active' ? 'selected' : '' }}>Active</option>
                      <option value="0" {{ old('status',$emailTemplate->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                  </div>
                  <div class="form-group col-lg-12">
                    <label>Body</label>
                    <textarea class="form-control" name="body" placeholder="Enter Message Body" required>{{ old('body') }}</textarea>
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
     
</body>
</html>