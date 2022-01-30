   @extends('layouts.app')

   @section('content')
   <div class="container">
       <div class="row justify-content-center">
           <div class="col-md-8">
               <div class="card">
                   <div class="card-header">@lang('Get In Touch With Us')</div>
         @if(session()->has('success'))
            <div class="alert alert-success">
               {{ session()->get('success') }}
            </div>
         @endif

                <div class="card-body">
                    <form method="POST" id="contactForm" action="{{ route('contact.sendMail') }}">
                        @csrf
                        <input type="hidden" name="application" value="{{$application}}" />
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="message" class="col-md-4 col-form-label text-md-right">@lang('Your message')</label>

                            <div class="col-md-6">
                              <textarea name="message" id="message" class="form-control @error('name') is-invalid @enderror"
                                        style="min-height:100px;" value="{{ old('message') }}" required></textarea>

                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">


 <x-submit-button submitText="{{__('Send e-mail')}}" cancelText="{{ __('Cancel')}}" cancelUrl="{{ route('home') }}"/>                                
                        </div>
                        </div>
                    </form>
                </div>
            </div>
         
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection