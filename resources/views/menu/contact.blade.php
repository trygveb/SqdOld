@extends('layouts.app')

@section('content')
<div class="abc-content">
    <div style="">
        <div  class="centered" style="max-width:500px;">
            <h2 class="entry-title add-bottom">@lang('Get In Touch With Us')</h2>
            <p>@lang('Contact1')</p>
            <form method="post"  action="{{ route('contact.sendMail') }}">
            OBS! Du måste svara rätt på denna säkerhetsfråga, annars skickas inget mail!
            Hur mycket är <input type="text" size=2 style="text-align:right" name="add1" value="{{$add1}}" readonly> +
            <input type="text" size=2 style="text-align:right" name="add2"  value="{{$add2}}" readOnly>? 
            <input type="text" size=2 style="text-align:right" name="addSum"  autofocus><br><br>
                {{ csrf_field() }}
                @if ($errors->has('name'))
                    @component('front.components.error')
                        {{ $errors->first('name') }}
                    @endcomponent
                @endif 
                <div class="form-group">
                    <input id="name" placeholder="@lang('Your name')" type="text" class="form-control"  name="name" value="{{ old('name') }}" required >
                </div>
                @if ($errors->has('email'))
                    @component('front.components.error')
                        {{ $errors->first('email') }}
                    @endcomponent
                @endif 
                <div class="form-group">
                    <input id="email" placeholder="@lang('Your email')" type="email" class="form-control"  name="email" value="{{ old('email') }}" required>
                </div>
                @if ($errors->has('message'))
                    @component('front.components.error')
                        {{ $errors->first('message') }}
                    @endcomponent
                @endif 
                <div class="form-group">
                    <textarea name="message" id="message" class="form-control" style="min-height:100px;"
                              placeholder="@lang('Your message')" ></textarea>
                </div>

                <button type="submit" class="submit button-primary full-width-on-mobile">@lang('Submit')</button>

            </form> <!-- end form -->
            @if (session('ok'))
                @component('front.components.alert')
                    @slot('type')
                        success
                    @endslot
                    {!! session('ok') !!}
                @endcomponent
            @endif
        </div>
    </div>
</div>
      
@endsection