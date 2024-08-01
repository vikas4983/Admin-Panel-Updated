<div class="text-center">
    <h1>Welcome Admin</h1>
</div>
@php
   $abc=  Auth::guard('admin')->user()->email;
   dump( $abc);
@endphp
<div>
    <a href="{{url('logout')}}">Logout</a>
</div>