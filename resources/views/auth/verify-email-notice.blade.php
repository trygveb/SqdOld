@extends('layouts.app')

@section('content')
@php
   $linkSent='NO';
   $status='';
   if (session()->has('status')) {
      $status= session()->get('status');
      if ($status=='EmailVerification_OK') {
         $linkSent='YES';
      }
   } 
@endphp
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
             link_sent= {{$linkSent}}  status={{$status}}<br>

         @if ($linkSent == 'YES')
            <div class="alert alert-success">
            {{__('Your e-mail is verified')}}.
              
            </div>
         @elseif ($linkSent != 'NO')
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

         @if ($linkSent == 'NO')
            <div class="card-body">
               @if ( LaravelLocalization::getCurrentLocale()=='se')
                  @if(session()->has('danger'))
                     Innan du fortsätter måste du verifiera din e-post-adress. Du bör ha fått e-post med en länk att klicka på för detta ändamål.
                     Länken gäller bara i en timme. Vi
                     <button style="padding:0;vertical-align:inherit" class="btn btn-link" role="link" type="submit" >skickar gärna en ny länk.</button>
                     Tänk på att dessa meddelanden kan hamna i din skräpkorg.
                  @else
                     Tack för att du registrerat dig till {{$application}}! Du är nu inloggad.<br>
                     Innan du fortsätter måste du dock verifiera din e-post-adress genom att klicka på länken
                     (=knappen med texten {{__('Verify email address')}}) i e-postmeddelandet som du ska ha fått nyss.
                     <br>
                     När du har gjort det kan du klicka på {{__('Continue to')}} {{$application}}-knappen nedan.
                     <br>
                     Om du inte har fått e-postmeddelandet så
                     <button style="padding:0;vertical-align:inherit" class="btn btn-link" role="link" type="submit" >skickar vi gärna ett till.</button>
                     <br>
                  @endif
                  <br>
                  Mailet har avsändare "{{config('app.mailFromAdress')}}" och titeln "{{__('Verify email address')}}, {{config ('app.name')}}" och är undertecknat med {{config('app.mailFromName')}}, {{__('administrator on')}} {{config('app.name')}}
               @else
                  @if(session()->has('danger'))
                     Before you continue, you must verify your email address. You should have received an email with a link to click on for this purpose.
                     The link is only valid for one hour. We are 
                     <button style="padding:0;vertical-align:inherit" class="btn btn-link" role="link" type="submit" >happy to send you a new link.</button>
                     Keep in mind that these messages may end up in your junk email folder.                     
                  @else
                  Thanks for signing up! You are noe logged in.<br>
                  Before proceeding, however, you will need to verify your email address by clicking on the link
                  (=the button with text {{__('Verify email address')}}) in the email which you should have just received.
                  <br>
                  When you have done that, you can press the {{__('Continue to')}} {{$application}}-button below.
                  <br>
                  If you didn\'t receive the email, we will 
                  <button style="padding:0;vertical-align:inherit" class="btn btn-link" role="link" type="submit" >gladly send you another.</button>
                  <br>
                  @endif
                  <br>
                  The email has the sender "{{config('app.mailFromAdress')}}" and the title "{{__('Verify email address on')}} {{config ('app.name')}}" and is signed with {{config('app.mailFromName')}}, {{__('administrator on')}} {{config ('app.name') }}
               @endif
               <br><br>
               @if (session('status') == 'verification-link-sent')
                  {{ __('A new verification link has been sent to the email address you provided during registration.') }}
               @endif
               <br>
               <a class="btn btn-primary" href="{{ route($application.'.home',[]) }}">{{__('Continue to')}} {{$application}}</a>
             @else
             <a style="margin-left:5px;" onclick="closeWindow()" href="" class="btn btn-secondary"> {{ __('Close window')}}</a>
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