@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-body">
                @if ( LaravelLocalization::getCurrentLocale()=='se')
               Tack för att du registrerat dig! Innan du loggar in måste du verifiera din e-post-adress genom att klicka på länken vi just mailade till dig. Om du inte har fått e-postmeddelandet skickar vi gärna ett till.
               @else 
               Thanks for signing up! Before getting started, you must verify your email address by clicking on the link we just emailed to you. If you didn\'t receive the email, we will gladly send you another.
               @endif
               <br>
           @if (session('status') == 'verification-link-sent')
               {{ __('A new verification link has been sent to the email address you provided during registration.') }}
           @endif
           <br>

               <form method="POST" action="{{ route('verification.send') }}">
                   @csrf

                   <div>
                     <button type="submit" class="btn btn-primary">
                         {{ __('Resend Verification Email')}}
                     </button>
                   </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection