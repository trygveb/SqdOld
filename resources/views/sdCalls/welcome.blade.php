@extends('sdCalls.layout')

@section('content')
<div class="container">
   <div class="col-md-12 text-center">

      <h1 class="text-center"> {{ __('Welcome to')}} SdCalls</h1>
    
   @guest
      <br>
      <a class="nav-link" href="{{ route('showLoginForm',['application' =>'sdCalls']) }}">{{ __('Login') }}</a>
      {{ __('or') }}
      <a class="nav-link" href="{{ route('showRegisterForm',['application' =>'sdCalls']) }}">{{ __('Register') }}</a>       
   @endguest
   @auth
   @if (! Auth::user()->hasVerifiedEmail())
   {{__('Please confirm your email')}}!
   @endif
   @endauth
   </div>    
</div>
@endsection
