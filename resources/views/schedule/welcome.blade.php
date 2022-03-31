@extends('schedule.layout')

@section('content')


<div class="container">
   <div class="col-md-12 text-center">

      <h1 class="text-center"> {{ __('Welcome to')}} {{$names['application']}}</h1>
      <table style="text-align:left;">
      </table>
   @guest
      <br>
      <a class="nav-link" href="{{route('showLoginForm')}}">{{ __('Login') }}</a>
      {{ __('or') }}
      <a class="nav-link" href="{{route('showRegisterForm')}}">{{ __('Register') }}</a>       
   @endguest
   @auth
      @if (! Auth::user()->hasVerifiedEmail())
         <a href="{{route('verification.notice')}}">{{__('Please confirm your email')}}!</a>
      @else
         @if ($mySchedulesCount > 0)
         {{__('Select schedule')}}<br>
            <ul style="list-style-type:none;">
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
