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
            <legend>{{__('Schedules')}} <a class="btn btn-link" style="float:right;" id="help_link" onclick="showHelp()" >{{__('Help')}}</a></legend>
            
        <table class="table table-bordered">
            <caption>{{__('My schedules')}}</caption>
            <tr>
              <th style="vertical-align:middle;" class="text-nowrap text-center">{{__('Name')}}</th>
              <th class="text-nowrap text-center" >{{__('Description')}}</th>
              <th class="text-nowrap text-center" >{{__('Administrator')}}</th>
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
               </tr>
         @endforeach
         </table>
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
