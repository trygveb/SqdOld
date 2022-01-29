@extends('layouts.app')

@section('content')
<div class="container">
   <form method="post"  id="contactForm" action="{{ route('contact.sendMail') }}">
      <fieldset>
         <legend>@lang('Get In Touch With Us')</legend>
         {{ csrf_field() }}
         @error('password')
            <span class="invalid-feedback" role="alert">
                 {{ $errors->first('name') }}
           </span>
         @enderror         
         
         <div class="form-group">
             <input id="name" placeholder="@lang('Your name')" type="text" class="form-control"  name="name" value="{{ old('name') }}" required >
         </div>
         @error('email')
            <span class="invalid-feedback" role="alert">
                 {{ $errors->first('email') }}
           </span>
         @enderror         
         <div class="form-group">
             <input id="email" placeholder="@lang('Your email')" type="email" class="form-control"  name="email" value="{{ old('email') }}" required>
         </div>
         @error('message')
            <span class="invalid-feedback" role="alert">
                 {{ $errors->first('message') }}
           </span>
         @enderror         
         <div class="form-group">
             <textarea name="message" id="message" class="form-control" style="min-height:100px;"
                       placeholder="@lang('Your message')" ></textarea>
         </div>

         <button type="submit" class="g-recaptcha submit button-primary full-width-on-mobile"
               data-sitekey="6Lf3QkUeAAAAAMLN9PR5lSFhJiZKoWziH98BNw5W" 
               data-callback='onSubmit' 
               data-action='submit'>@lang('Submit')</button>
      </fieldset>
   </form> 
</div>
      
@endsection
@section('scripts')
<script>
   function onSubmit(token) {
     document.getElementById("contactForm").submit();
   }
 </script>
@endsection
