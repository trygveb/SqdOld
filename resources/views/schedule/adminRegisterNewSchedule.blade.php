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

       <legend id="legend">{{__('New schedule')}}<a class="btn btn-link" style="float:right;" id="help_link" onclick="showHelp()" >{{__('Help')}}</a></legend>

      <div class="form-info-text" id="help_text" style="display:none;">

      {{__('New schema help text.')}}
      <br> <br>
      </div>

      <div class="form-group row">
          <label for="schedule_name" class="label_name_input col-md-4 col-form-label text-md-right" >{{ __('Schema name') }} *</label>
          <div class="col-md-6">
              <input id="schedule_name" type="text" class="name_input form-control @error('schedule_name') is-invalid @enderror"
                     name="schedule_name"  value="{{ old('schedule_name') }}" maxlength="24" required  autofocus>
          </div>
      </div>
      <div class="form-group row">
          <label for="schedule_description" class="label_name_input col-md-4 col-form-label text-md-right" >{{ __('Description') }}</label>
          <div class="col-md-6">
              <input id="schedule_description" type="text" class="name_input form-control @error('schedule_description') is-invalid @enderror"
                     name="schedule_description"  style="width:120%;" value="{{ old('schedule_description') }}" maxlength="48"   autofocus>
          </div>
      </div>

      <div class="form-group row">
          <label for="weekday-select" class="label_name_input col-md-4 col-form-label text-md-right" >{{ __('Weekday') }} *</label>
         <div class="col-md-6">
            <select class="form-select" aria-label="{{ __('Weekday') }}" name="weekday" id="weekday-select" required>
               <option value="1">{{ __('Mondays')}}</option>
               <option value="2">{{ __('Tuesdays')}}</option>
               <option value="3">{{ __('Wednesdays')}}</option>
               <option value="4">{{ __('Thursdays')}}</option>
               <option value="5">{{ __('Fridays')}}</option>
               <option value="6">{{ __('Saturdays')}}</option>
               <option value="7">{{ __('Sundays')}}</option>
           </select>
         </div>
      </div>

      <div class="form-group row">
         <label for="schedule_time" class="label_name_input col-md-4 col-form-label text-md-right" >{{ __('Starting at') }} *</label>
          <div class="col-md-6">
              <input id="schedule_time" type="time" class="name_input form-control @error('schedule_time') is-invalid @enderror"
                     name="schedule_time"  required value="{{ old('schedule_time') }}">
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
