@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="card">
         <div class="card-body">

            <h1>{{__('About')}} sqd.se</h1>
            sqd.se {{__('is owned by Trygve Botnen. Use the')}} <a href="{{ route('contact.showForm') }}">{{__('Contact Form')}}</a> {{__('if you want to contact me')}}!
            <br><br>
            {{__('The application code is  written in PHP using the Laravel Framework version')}} {{app()->version()}}.<br>
            {{__('The source code is open and available at')}} <a href="https://github.com/trygveb/Sqd">Github</a>.
         </div>
      </div>
   </div>
</div>

@endsection
@section('scripts')

@endsection