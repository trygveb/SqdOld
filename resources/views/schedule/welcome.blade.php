@extends('schedule.layout')

@section('content')


<div class="container">
   <div class="col-md-12 text-center">

      <h1 class="text-center"> {{ __('Welcome to')}} {{$names['application']}}</h1>
      <table style="text-align:left;">
          <caption>{{__('News')}} 2022-03-05</caption>
          <tr>
              <td>{{__('SdSchema has changed domain, from sqd.trygveb.se to schema.sqd.se')}}</td>
         </tr><tr>
             <td>{{__('Please change any bookmarks. However, the old address will work for another month or two')}}.</td>
         </tr><tr>
             <td>{{__('The application is now bilingual and GDPR compliant. The latter means, among other things, that you must approve cookies every 90 days')}}.</td>
            </tr><tr>
                <td>{{__('In addition, the following small changes for regular users')}}:</td>
            </tr><tr>
                <td>
                  <ul>
                      <li>{{__('There is a new menu at the top right with, among other things, privacy policy')}}.</li>
                      <li>{{__('Attendance status Maybe has been replaced by a question mark')}}.</li>
                      <li>{{__('There is now a possibility for users to unregister')}}.</li>
                  </ul>
                </td>
         </tr>
         <tr>
             <td>{{__('Feel free to report any problems via the new')}} <a href="{{route('about')}}">{{__('contact form')}}</a>.</td>
         </tr>
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
