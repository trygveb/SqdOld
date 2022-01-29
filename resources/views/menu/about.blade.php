@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="card">
         <div class="card-body">

            <h1>Om oss</h1>
               sqd.se ägs och drivs av Trygve Botnen. Använd <a href="{{ route('contact.showForm') }}">@lang('ContactForm')</a> om du vill kontakta oss!
         </div>
      </div>
   </div>
</div>

@endsection
@section('scripts')

@endsection