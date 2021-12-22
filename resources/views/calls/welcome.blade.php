@extends('layouts.app')

@section('content')
<div class="container">
   <div class="col-md-12 text-center">

      <h1 class="text-center"> Välkommen till SdCalls</h1>
    
   @guest
      <br>
      <a class="nav-link" href="{{ route('login',['app' =>'calls']) }}">{{ __('Login') }}</a>
       

      
   @if (Route::has('register'))
      eller
      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
   @endif
   @endguest
   </div>    
</div>
@endsection
