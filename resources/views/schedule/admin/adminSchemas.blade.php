@extends('schedule.layout')
@section('menu1')
@endsection
@section('content')

  <div class="container">

      <div class="table-responsive" style="overflow-x:auto; overflow-y:hidden;">

         <a  href="{{route('schedule.showRegisterSchedule')}}">{{__('Create new schedule')}}</a>
   
        <form id="myForm" action="{{ route('schedule.register')}}" method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="userId" value="{{Auth::id()}}">
          <fieldset style="min-width:850px;">
            <legend>{{__('Schedules')}}</legend>
            
        <table class="table table-bordered">
            <caption>{{__('My schedules')}}</caption>
            <tr>
              <th style="vertical-align:middle;" class="text-nowrap text-center">{{__('Show')}}</th>
              <th style="vertical-align:middle;" class="text-nowrap text-center">{{__('Name')}}</th>
              <th class="text-nowrap text-center" >{{__('Description')}}</th>
              <th class="text-nowrap text-center" >{{__('Admin(s)')}}</th>
            </tr>
            <!--<tbody>-->

        @foreach ($myVMemberSchedules as $myVMemberSchedule)
         @php
            $schemaNameInput='name'.$myVMemberSchedule->schedule_id;
            $schemaDescriptionInput='description'.$myVMemberSchedule->schedule_id;
            $columnId='myCol_'.$myVMemberSchedule->schedule_id;
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
