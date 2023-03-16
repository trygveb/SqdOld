@extends('schedule.layout')
@section('menu1')
@endsection
@section('content')

  <div class="container">

      <div class="table-responsive" style="overflow-x:auto; overflow-y:hidden;">

   
        <form id="myForm" action="{{ route('schedule.updateSchedule')}}" method="POST" name="firefoxSpecial">
          {{ csrf_field() }}
          <input type="hidden" name="userId" value="{{Auth::id()}}">
          <fieldset style="min-width:850px;">
            <legend>{{__('My schedules')}}</legend>
         
            
        <table class="table table-bordered">
            <caption></caption>
            <tr>
              <th style="vertical-align:middle;" class="text-nowrap text-center">{{__('Show')}}</th>
              <th style="vertical-align:middle;" class="text-nowrap text-center">{{__('Name')}}</th>
              <th class="text-nowrap text-center" >{{__('Description')}}</th>
              <th class="text-nowrap text-center" >{{__('Weekday')}}</th>
              <th class="text-nowrap text-center" >{{__('Starting at')}}</th>
              <th class="text-nowrap text-center" >{{__('Administrator')}}</th>
            </tr>
            <!--<tbody>-->

        @foreach ($myVMemberSchedules as $myVMemberSchedule)
         @php
            $schemaNameInput='name_'.$myVMemberSchedule->schedule_id;
            $schemaDescriptionInput='description_'.$myVMemberSchedule->schedule_id;
         @endphp
               <tr class='status'>
                  <td class="text-nowrap" >
                      <a href="{{route('schedule.index',$myVMemberSchedule->schedule_id)}}">{{__('Show')}}</a>
                  </td>
                  <td class="text-nowrap" >
                      @if ($myVMemberSchedule->isAdmin > 0)
                       <input type="text" maxlength=30 size=20 name="{{$schemaNameInput}}"  required value="{{$myVMemberSchedule->schedule_name}}" >
                       @else
                       {{$myVMemberSchedule->schedule_name}}
                       @endif
                  </td>
                  <td class="text-nowrap">
                      @if ($myVMemberSchedule->isAdmin > 0)
                       <input type="text" maxlength=48 size=26 name="{{$schemaDescriptionInput}}"  value="{{$myVMemberSchedule->schedule_description}}" >
                       @else
                       {{$myVMemberSchedule->schedule_description}}
                       @endif
                      
                  </td>
                  <td class="text-nowrap">
                      @if ($myVMemberSchedule->isAdmin > 0)
                        <select class="form-select" aria-label="{{ __('Weekday') }}" name="weekday" id="weekday-select" required >
                           <option value="1" @if ($myVMemberSchedule->default_weekday==1) selected @endif>{{ __('Mondays')}}</option>
                           <option value="2" @if ($myVMemberSchedule->default_weekday==2) selected @endif>{{ __('Tuesdays')}}</option>
                           <option value="3" @if ($myVMemberSchedule->default_weekday==3) selected @endif>{{ __('Wednesdays')}}</option>
                           <option value="4" @if ($myVMemberSchedule->default_weekday==4) selected @endif>{{ __('Thursdays')}}</option>
                           <option value="5" @if ($myVMemberSchedule->default_weekday==5) selected @endif>{{ __('Fridays')}}</option>
                           <option value="6" @if ($myVMemberSchedule->default_weekday==6) selected @endif>{{ __('Saturdays')}}</option>
                           <option value="7" @if ($myVMemberSchedule->default_weekday==7) selected @endif>{{ __('Sundays')}}</option>
                       </select>
                       @else
                        <select class="form-select" aria-label="{{ __('Weekday') }}" name="weekday" id="weekday-select" disabled >
                           <option value="1" @if ($myVMemberSchedule->default_weekday==1) selected @endif>{{ __('Mondays')}}</option>
                           <option value="2" @if ($myVMemberSchedule->default_weekday==2) selected @endif>{{ __('Tuesdays')}}</option>
                           <option value="3" @if ($myVMemberSchedule->default_weekday==3) selected @endif>{{ __('Wednesdays')}}</option>
                           <option value="4" @if ($myVMemberSchedule->default_weekday==4) selected @endif>{{ __('Thursdays')}}</option>
                           <option value="5" @if ($myVMemberSchedule->default_weekday==5) selected @endif>{{ __('Fridays')}}</option>
                           <option value="6" @if ($myVMemberSchedule->default_weekday==6) selected @endif>{{ __('Saturdays')}}</option>
                           <option value="7" @if ($myVMemberSchedule->default_weekday==7) selected @endif>{{ __('Sundays')}}</option>
                       </select>
                       @endif
                      
                  </td>
                  <td>
                      @if ($myVMemberSchedule->isAdmin > 0)
                     <input id="schedule_time" type="time"  
                     name="schedule_time"  required value="{{ $myVMemberSchedule->default_start_time }}"  step="60" >
                     @else
                     {{ $myVMemberSchedule->default_start_time }}
                     @endif
                  </td>
                  <td class="text-nowrap">
                      {{$myVMemberSchedule->admins}}
                  </td>
               </tr>
         @endforeach
         
 
         </table>
            <x-submit-button submitText="{{ __('Save changes')}}" cancelText="{{ __('Cancel')}}" cancelUrl="{{route('home')}}"/>
         </fieldset>

        </form>
     </div>
 </div>
<!--</div>-->
@section('scripts')
<script>
   // Fix Firefox bug for selected option 
   window.onload = function() { document.forms['firefoxSpecial'].reset(); };
</script>
@endsection

@endsection
