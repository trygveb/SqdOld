@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="card" style="max-width:800px;">
         <div class="card-header">{{__('Cookie Policy')}}</div>
         <div class="card-body">
            @include('menu.cookiePolicyText')
         </div>
         </div>
      </div>       
   </div>
<!--</div>-->

@endsection
@section('scripts')

@endsection