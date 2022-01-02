@extends('sdSchema.layout')

@section('content')
<div class="container">
   <div class="col-md-12 text-center">

      <h1 class="text-center"> {{ __('Welcome to')}} SdSchema</h1>
    
   @guest
      <br>
      <a class="nav-link" href="{{ route('login',['application' =>'sdSchema']) }}">{{ __('Login') }}</a>
   @if (Route::has('register-user'))
      {{ __('or') }}
      <a class="nav-link" href="{{ route('register-user', ['application' =>'sdSchema']) }}">{{ __('Register') }}</a>       
   @endif
   @endguest
   @auth
   <!--$myTrainingsCount-->
      @if (0 > 0)
         Välj schema <a href="{{route('schema.index',1)}}">C3 Onsdgagar</a>
      @else
         Du är inte ansluten till något schema ännu.
      @endif
   @endauth
   </div>    
</div>
@endsection
