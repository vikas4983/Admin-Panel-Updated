<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    body {
      background-color: #9E6DE0;
    }

    .rows {
      height: 100vh;
    }

    .form-control {
      display: block;
      width: 100%;
      min-height: calc(1.5em + .75rem + 2px);
      padding: .575rem .75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      border-radius: 52px;
      transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .card {
      padding: 20px;
      background-color: #eee;
      padding-bottom: 50px;
      padding-top: 50px;
    }

    .form-control:focus {
      color: #495057;
      background-color: #fff;
      border-color: #f9a826;
      outline: 0;
      box-shadow: none;
    }

    .border-rad {
      border-top-right-radius: 28px;
      border-bottom-right-radius: 28px;
      color: #fff;
      background-color: #f9a826;
      border-color: #f9a826;
    }

    .border-rad:hover {
      background-color: #f9a826;
      border-color: #f9a826;
    }
  </style>
</head>

<body>
 @php
   $otp = $admin->otps->first()->otp;
   
 @endphp
  <div class="row d-flex justify-content-center align-items-center rows">
    <div class="col-md-6">
      <div class="card">
        <div class="text-center"> 
          <img src="https://i.imgur.com/Dh7U4bp.png" width="200">
          <div>
            <span class="d-block mt-3">Dear {{ $admin['name'] }}, <br><br> {{$otp}} is your one time password (OTP). please do not share the OTP with others.</span>
          </div>
          <div class="mx-5">
            {{-- <div class="input-group mb-3 mt-4">
                          <input type="text" class="form-control" placeholder="Enter email" aria-label="Recipient's username" aria-describedby="button-addon2">
                          <button class="btn btn-success border-rad" type="button" id="button-addon2">Subscribe</button>
                        </div> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>