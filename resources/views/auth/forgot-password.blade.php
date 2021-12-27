@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               <div class="card-header">{{ __('Forgot Your Password?') }}</div>            
               <div class="card-body">
                
            {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        

        <!-- Session Status -->
<!--        <x-auth-session-status class="mb-4" :status="session('status')" />

         Validation Errors 
        <x-auth-validation-errors class="mb-4" :errors="$errors" />-->
<br><br>
               <form method="POST" action="{{ route('password.email') }}">
                   @csrf

                   <!-- Email Address -->
                  <div>
                       <label for="email" >{{__('E-Mail Address')}}</label>
                       <input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                  </div>
                   <br>
<!--                  <div class="form-group row mb-0">
                     <div class="col-md-8 offset-md-4">-->
                        <x-submit-button submitText="{{ __('Send Password Reset Link')}}" cancelText="{{ __('Cancel') }}"/>
<!--                     </div>                   
                  </div>-->
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection