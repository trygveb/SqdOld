@extends('schedule.layout')
@section('menu1')
@endsection
@section('content')

  <div class="container">

      <div class="table-responsive" style="overflow-x:auto; overflow-y:hidden;">

        <form id="myForm" action="{{ route('schedule.register')}}" method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="userId" value="{{Auth::id()}}">
          <fieldset>
            <legend>{{__('Schedules')}}</legend>
            
        <table class="table table-bordered">
            <caption>{{__('My schedules')}}</caption>
            <tr>
              <th style="vertical-align:middle;" class="text-nowrap text-center">{{__('Name')}}</th>
              <th class="text-nowrap text-center" >{{__('Description')}}</th>
              <th class="text-nowrap text-center" >{{__('Admin(s)')}}</th>
              <th class="text-nowrap text-center" >{{__('Password')}}</th>
              <th class="text-nowrap text-center" >{{__('Member')}}</th>
              <th class="text-nowrap text-center" >{{__('Number')}}</th>
            </tr>
            <!--<tbody>-->

        @foreach ($myVMemberSchedules as $myVMemberSchedule)
         @php
            $cbName='mySchedule_'.$myVMemberSchedule->schedule_id;
            $columnId='myCol_'.$myVMemberSchedule->schedule_id;
         @endphp
               <tr class='status'>
                  <td class="text-nowrap" >
                      <a href="{{route('schedule.index',$myVMemberSchedule->schedule_id)}}">{{$myVMemberSchedule->schedule_name}}</a>
                  </td>
                  <td class="text-nowrap">
                      {{$myVMemberSchedule->schedule_description}}
                  </td>
                  <td class="text-nowrap">
                      {{$myVMemberSchedule->admins}}
                  </td>
                  <td class="text-nowrap text-center" id="{{$columnId}}">
                      {{strlen($myVMemberSchedule->password)===0?__('No'):__('Yes')}}
                  </td>
                  <td class="text-nowrap text-center" style="padding:2px 5px 2px 5px;">
                      <input type="hidden" name="{{$cbName}}" value="0" />
                        <input type="checkbox" checked name="{{$cbName}}" id="{{$cbName}}" onclick='myScheduleClicked(this.name)' value="1">
                  </td>
                  <td class="text-nowrap">
                      {{$myVMemberSchedule->group_size}}
                  </td>
               </tr>
         @endforeach
         </table>
         <table class="table table-bordered">
            <caption>{{__('Other schedules')}}</caption>
            <tr>
              <th style="vertical-align:middle;" class="text-nowrap text-center">{{__('Name')}}</th>
              <th class="text-nowrap text-center" >{{__('Description')}}</th>
              <th class="text-nowrap text-center" >{{__('Admin(s)')}}</th>
              <th class="text-nowrap text-center" >{{__('Password')}}</th>
              <th class="text-nowrap text-center" >{{__('Add me')}}</th>
              <th class="text-nowrap text-center" >{{__('Number')}}</th>
            </tr>
            

         @foreach ($otherSchedules as $otherSchedule)
            @php
               $cbName='otherSchedule_'.$otherSchedule->id;
               $columnId='otherCol_'.$otherSchedule->id;
               $pwInputName='pwInput_'.$otherSchedule->id;
               $numberInputName='numberInput_'.$otherSchedule->id;
            @endphp
               <tr class='status'>
                  <td class="text-nowrap" >
                      {{$otherSchedule->name}}
                  </td>
                  <td class="text-nowrap">
                      {{$otherSchedule->description}}
                  </td>
                  <td class="text-nowrap">
                      {{strlen($otherSchedule->password)===0 ? $otherSchedule->admins : ''}}   
                      <input type="hidden" name="{{$pwInputName}}" id="{{$pwInputName}}">
                  </td>
                  <td class="text-nowrap text-center" id="{{$columnId}}">
                      {{strlen($otherSchedule->password)===0?__('No'):__('Yes')}}
                  </td>
                  <td class="text-nowrap text-center" style="padding:2px 5px 2px 5px;">
                      <input type="hidden" name="{{$cbName}}" value="0" />
                        <input type="checkbox" name="{{$cbName}}" id="{{$cbName}}" onclick='otherScheduleClicked(this.name)' value="1">
                  </td>
                  <td class="text-nowrap">
                      <input type="number" name="{{$numberInputName}}" value="2" min="1" max="2" size="3">
                  </td>
               </tr>
        @endforeach
            <!--</tbody>-->
         </table>
            <x-submit-button submitText="{{ __('Save changes')}}" cancelText="{{ __('Cancel')}}" cancelUrl="{{route('schedule.index')}}"/>
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
