@extends('calls.layout')

@section('content')
<div class="container">
   <div class="col-md-12 text-center">

      <h1 class="text-center"> {{ __('Welcome to')}} SdCalls</h1>
    
   @guest
      <br>
      <a class="nav-link" href="{{ route('login',['app' =>'SdCalls']) }}">{{ __('Login') }}</a>
      {{ __('or') }}
      <a class="nav-link" href="{{ route('register-user',['app' =>'SdCalls']) }}">{{ __('Register') }}</a>       
   @endguest
   @auth
   @endauth
   </div>    
</div>
@endsection
