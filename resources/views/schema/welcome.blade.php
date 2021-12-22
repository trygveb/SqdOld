@extends('layouts.app')

@section('content')
<div class="container">
   <div class="col-md-12 text-center">

      <h1 class="text-center"> Välkommen till SdSchema</h1>
    
   @guest
      <br>
      <a class="nav-link" href="{{ route('login',['app' =>'schema']) }}">{{ __('Login') }}</a>
       
   @if (Route::has('register'))
      eller
      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
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
