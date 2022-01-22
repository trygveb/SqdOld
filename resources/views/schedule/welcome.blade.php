@extends('schedule.layout')

@section('content')
<div class="container">
   <div class="col-md-12 text-center">

      <h1 class="text-center"> {{ __('Welcome to')}} SdSchema</h1>

   @guest
      <br>
      <a class="nav-link" href="{{ route('showLoginForm',['application' =>'schedule']) }}">{{ __('Login') }}</a>
      {{ __('or') }}
      <a class="nav-link" href="{{ route('showRegisterForm', ['application' =>'schedule']) }}">{{ __('Register') }}</a>       
   @endguest
   @auth
      @if (! Auth::user()->hasVerifiedEmail())
         <a href="{{route('verification.notice',['application' => 'schedule'])}}">{{__('Please confirm your email')}}!</a>
      @else
         @if ($mySchedulesCount > 0)
         {{__('Select schedule')}}<br>
            <ul>
         @foreach ($vMemberSchedules as $vMemberSchedule)
               <li><a href="{{route('schedule.index',$vMemberSchedule->schedule_id)}}">{{$vMemberSchedule->schedule_name}}</a></li>
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
