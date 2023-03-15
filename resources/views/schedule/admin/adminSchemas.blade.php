@extends('schedule.layout')
@section('menu1')
@endsection
@section('content')

  <div class="container">

      <div class="table-responsive" style="overflow-x:auto; overflow-y:hidden;">

   
        <form id="myForm" action="{{ route('schedule.updateSchedule')}}" method="POST">
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
                       <input type="text" maxlength=30 size=24 name="{{$schemaNameInput}}"  required value="{{$myVMemberSchedule->schedule_name}}" >
                       @else
                       {{$myVMemberSchedule->schedule_name}}
                       @endif
                  </td>
                  <td class="text-nowrap">
                      @if ($myVMemberSchedule->isAdmin > 0)
                       <input type="text" maxlength=48 size=36 name="{{$schemaDescriptionInput}}"  value="{{$myVMemberSchedule->schedule_description}}" >
                       @else
                       {{$myVMemberSchedule->schedule_description}}
                       @endif
                      
                  </td>
                  <td class="text-nowrap">
                      @if ($myVMemberSchedule->isAdmin > 0)
                        <select class="form-select" aria-label="{{ __('Weekday') }}" name="weekday" id="weekday-select" required>
                           <option value="1">{{ __('Mondays')}}</option>
                           <option value="2">{{ __('Tuesdays')}}</option>
                           <option value="3">{{ __('Wednesdays')}}</option>
                           <option value="4">{{ __('Thursdays')}}</option>
                           <option value="5">{{ __('Fridays')}}</option>
                           <option value="6">{{ __('Saturdays')}}</option>
                           <option value="7">{{ __('Sundays')}}</option>
                       </select>
                       @else
                       {{$myVMemberSchedule->default_weekday}}
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
   function otherScheduleClicked(name) {
      cb= document.getElementById(name);
      scheduleId=name.substr(14);
      restricted= document.getElementById('otherCol_'+scheduleId).innerHTML.trim();
      if (cb.checked && restricted==="{{__('Yes')}}") {
         let password= prompt("{{__('Please enter the Password')}}."+
                 " {{__('If the password is correct, you will be added to the schedule when you press the')}}"+
                 " {{__('Save changes')}}"+
                 " {{__('button')}}.");
         document.getElementById('pwInput_'+scheduleId).value=password;
      }
   }
   function myScheduleClicked(name) {
      cb= document.getElementById(name);
      if (! cb.checked) {
          alert("{{__('Do you really want to remove yourself from this schedule')}}?"+
                " {{__('You will be removed from the schedule when you press the')}}"+
                " {{__('Save changes')}}"+
                " {{__('button')}}.");
       }
   }
</script>
@endsection

@endsection
