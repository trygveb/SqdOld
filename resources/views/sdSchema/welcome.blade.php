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
         @if ($myTrainingsCount > 0)
         {{__('Select schedule')}}<br>
            <ul>
         @foreach ($vMemberTrainings as $vMemberTraining)
               <li><a href="{{route('schema.index',$vMemberTraining->training_id)}}">{{$vMemberTraining->training_name}}</a></li>
         @endforeach
            </ul>
         @else
         {{__('You are not registered with any schedule yet')}}.
         @endif
      @endif
   @endauth
   </div>    
</div>
@endsection
