@extends('sdSchema.layout')

@section('content')
<div class="container">
   <div class="col-md-12 text-center">

      <h1 class="text-center"> {{ __('Welcome to')}} SdSchema</h1>

   @guest
   <br>
   <a class="nav-link" href="{{ route('showLoginForm',['application' =>'sdSchema']) }}">{{ __('Login') }}</a>
   {{ __('or') }}
   <a class="nav-link" href="{{ route('showRegisterForm', ['application' =>'sdSchema']) }}">{{ __('Register') }}</a>       
   @endguest
   @auth
   @if (! Auth::user()->hasVerifiedEmail())
   <a href="{{route('verification.notice',['application' => 'sdSchema'])}}">{{__('Please confirm your email')}}!</a>
   @else
   <!--$myTrainingsCount-->
      @if (0 > 0)
         Välj schema <a href="{{route('schema.index',1)}}">C3 Onsdgagar</a>
      @else
         Du är inte ansluten till något schema ännu.
      @endif
   @endif
   @endauth
   </div>    
</div>
@endsection
