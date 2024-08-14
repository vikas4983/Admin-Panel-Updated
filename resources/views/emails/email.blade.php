<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- Login With OTP --}}
    
    @if(isset($type['type']) && $type['type'] === 'login')
    <x-login-with-otp-component :admin="$admin"/>
@endif
    {{-- Forgot OTP --}}
   
    @if(isset($type['type']) && $type['type'] === 'forgot')
    
    <x-forgot-otp-component :admin="$admin" />
    @endif
     {{-- Resend OTP --}}
    @if(isset($type['type']) && $type['type'] === 'resend')
    <x-resend-otp-component :admin="$admin" />
    @endif
</body>
</html>