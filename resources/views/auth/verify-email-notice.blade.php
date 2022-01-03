@extends('layouts.app')

@section('content')
@php
   $emailVerified='NO';
   $status='';
   if (session()->has('status')) {
      $status= session()->get('status');
      if ($status=='EmailVerification_OK') {
         $emailVerified='YES';
      }
   } 
@endphp
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
             emailVerified= {{$emailVerified}}  status={{$status}}<br>

         @if ($emailVerified == 'YES')
            <div class="alert alert-success">
            {{__('Your e-mail is verified')}}.
              
            </div>
         @elseif ($emailVerified != 'NO')
            <div class="alert alert-info">
            {{__('Sorry, something went wrong. Please report to the administrator of this website')}}.
            </div>
         @endif
         @if (session()->has('email'))
            <div class="alert alert-info">
            {{__('Sorry, something went wrong.').session()->get('email')}}
            </div>
         @endif
         <form method="POST" action="{{ route('verification.send') }}">
               @csrf

         @if ($emailVerified == 'NO')
            <div class="card-body">
            @if(session()->has('danger'))
               Before you continue, you must verify your email address. You should have received an email with a link to click on for this purpose.
               The link is only valid for one hour. We are 
               <button style="padding:0;vertical-align:inherit" class="btn btn-link" role="link" type="submit" >happy to send you a new link.</button>
               Keep in mind that these messages may end up in your junk email folder.                     
            @else
               {{__('Thanks for signing up to  :application! You are noW logged in.', ['application' => $application])}}
               <p>
                  <span style="font-size:larger;">
                     <b>{{__('Before proceeding, however, you will need to verify your email address')}}</b>
                  </span>
                   {{__('by clicking on the the button with text ":text" in the email* which you should have just received',
                              ['text' => __('Verify email address')])}}.
               </p>
               {{__('When you have done that, you can press the :BTN-button below', ['BTN' => __('Continue')])}}.
               
               <br><br>
               {{__('If you did not receive the email, we will')}}
                  <button style="padding:0;vertical-align:inherit" class="btn btn-link" role="link" type="submit" >
               {{__('gladly send you another')}}.</button>
               <br><br>
                  *){{__('The email has the sender ":mailFromAdress" and the title ":title" and is signed with ":signed"',
                     ['mailFromAdress' => config('app.mailFromAdress'),
                      'title' => __('Verify email address').', '. config('app.name'),
                      'signed' => config('app.mailFromName').', '.__('administrator on').config('app.name')])}}
                    <br>
            @endif
          @endif
          @if (session('status') == 'verification-link-sent')
               {{ __('A new verification link has been sent to the email address you provided during registration.') }}
               <a style="margin-left:5px;" onclick="closeWindow()" href="" class="btn btn-secondary"> {{ __('Close window')}}</a>
         @else
               <br>
               <a class="btn btn-primary" href="{{ route($application.'.home',[]) }}">{{__('Continue')}}</a>
         @endif
             </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection

@section('scripts')
<script>
   /**
    * Close this window. 
    * The reason for having this function here instead of in public js folder
    * is that it must cope with locale texts
    */
   function closeWindow() {
      if (confirm("{{__('You are going to close the current window.')}}")) {
         window.close('','_parent','');
      } else {
         txt = "You pressed Cancel!";
      } 
   }
</script>

@endsection