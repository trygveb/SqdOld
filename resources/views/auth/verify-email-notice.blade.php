@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
      @if(session()->has('link_sent'))
         <div class="alert alert-success">
             {{ session()->get('link_sent') }}  Klicka på <a href="">denna länk</a> när du har klickat på länken i e-post-meddelandet..
         </div>
      @endif
            <div class="card-body">
               @if ( LaravelLocalization::getCurrentLocale()=='se')
                  @if(session()->has('danger'))
                     Innan du fortsätter måste du verifiera din e-post-adress. Du bör ha fått e-post med en länk att klicka på för detta ändamål.
                     Länken gäller bara i en timme. Vi skickar gärna en ny länk.
                     Tänk på att dessa meddelanden kan hamna i din skräpkorg.
                  @else 
                  Tack för att du registrerat dig! <br>
                  Innan du fortsätter måste du verifiera din e-post-adress genom att klicka på länken vi just mailade till dig.<br>
                  Om du inte har fått e-postmeddelandet skickar vi gärna ett till.<br>
                  @endif
                  <br>
                  Mailet har avsändare "trygve.botnen@gmail.com" och titeln "Verifiera e-postadressen på {{config('app.name')}}" och är undertecknat med Trygve Botnen, administratör på {{config('app.name')}}
               @else
                  @if(session()->has('danger'))
                     Before you continue, you must verify your email address. You should have received an email with a link to click on for this purpose.
                     The link is only valid for one hour. We are happy to send you a new link.
                     Keep in mind that these messages may end up in your junk email folder.                     
                  @else 
                     Thanks for signing up! Before you continue, you must verify your email address by clicking on the link we just emailed to you. If you didn\'t receive the email, we will gladly send you another.
                  @endif
               @endif
               <br><br>
           @if (session('status') == 'verification-link-sent')
               {{ __('A new verification link has been sent to the email address you provided during registration.') }}
           @endif
           <br>

               <form method="POST" action="{{ route('verification.send') }}">
                   @csrf
                   <div>
                       
 <x-submit-button submitText="{{ __('Resend Verification Email')}}" cancelText="{{ __('Cancel') }}"/>                       
                       
<!--                     <button type="submit" class="btn btn-primary">
                         {{ __('Resend Verification Email')}}
                     </button>-->
                   </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection