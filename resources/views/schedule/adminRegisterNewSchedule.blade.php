@extends('schedule.layout')

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>

@endif
 <div class="container" style="max-width:800px;">
   <h1>{{__('Register new schedule')}}</h1>

   <div>
   <form method="POST" id="registrationForm" action="{{ route('schedule.registerNewSchedule') }}">
      <fieldset style="max-width:550px;">
       @csrf
       <input type="hidden" name="application" value="{{$names['application']}}" />

       <legend id="legend">{{__('Register new schema')}}<a class="btn btn-link" style="float:right;" id="help_link" onclick="showHelp()" >{{__('Help')}}</a></legend>

      <div class="form-info-text" id="help_text" style="display:none;">

      {{__('New schema help text.')}}
      <br> <br>
      </div>

      <div class="form-group row">
          <label for="schema_name" class="label_name_input col-md-4 col-form-label text-md-right" >{{ __('Schema name') }} *</label>
          <div class="col-md-6">
              <input id="schema_name" type="text" class="name_input form-control @error('schema_name') is-invalid @enderror"
                     name="schema_name"  value="{{ old('schema_name') }}" maxlength="24" required  autofocus>
          </div>
      </div>

      <div class="form-group row">
          <label for="weekday-select" class="label_name_input col-md-4 col-form-label text-md-right" >{{ __('Weekday') }} *</label>
         <div class="col-md-6">
            <select class="form-select" aria-label="{{ __('Weekday') }}" name="weekday" id="weekday-select" required>
               <option value="1">{{ __('Monday')}}</option>
               <option value="2">{{ __('Tuesday')}}</option>
               <option value="3">{{ __('Wednesday')}}</option>
               <option value="4">{{ __('Thursday')}}</option>
               <option value="5">{{ __('Friday')}}</option>
               <option value="6">{{ __('Saturday')}}</option>
               <option value="7">{{ __('Sunday')}}</option>
           </select>
         </div>
      </div>

      <div class="form-group row">
         <label for="schema_time" class="label_name_input col-md-4 col-form-label text-md-right" >{{ __('Time of day') }} *</label>
          <div class="col-md-6">
              <input id="schema_time" type="time" class="name_input form-control @error('schema_name') is-invalid @enderror"
                     name="schema_time"  value="{{ old('schema_name') }}">
          </div>
      </div>

      <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
               <p style="float:right;">
               <button type="submit"  onclick="checkForm()" class="btn btn-primary" id="submit-button" >{{ __('Register')}}</button>
               <a style="margin-left:5px;" href="{{route($names['routeRoot'].'.home')}}" class="btn btn-secondary"> {{ __('Cancel')}}</a>
               </p>
          </div>
      </div>

      </fieldset>
   </form>
</div>


            
 </div>
@section('scripts')
<script>
window.onload = function () {
//   console.log('onload');
};


// TODO global showHelp function
function showHelp() {
   var helpText = document.getElementById("help_text");
   var helpLink= document.getElementById("help_link");
   if (helpText.style.display === 'none') {
      helpText.style.display='inline-block';
      helpLink.innerHTML="{{__('Hide Help')}}";
   } else {
      helpText.style.display='none';
      helpLink.innerHTML="{{__('Help')}}";
   }
}


</script>


@endsection

@endsection
