@extends('schedule.layout')
@section('menu1')



@if ($admin > 0)
   <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Administration
   </a>
   <div class="dropdown-menu" aria-labelledby="navbarDropdown">
   <a class="dropdown-item" href="{{route('schedule.showComments',['scheduleId' => $schedule->id])}}">{{__('Manage comments')}}</a>
   <a class="dropdown-item" href="{{route('schedule.showAddRemoveDates',['scheduleId' => $schedule->id])}}">{{__('Manage dates')}}</a>
   </div>
@endif
@endsection
@section('content')
@if (array_count_values($status) > 0)
   @foreach ($status as $key => $value)
         @if (str_contains($key,'error')) 
         <div class="alert alert-danger">
          {{ $value }}</li>
         </div>
         @endif
   @endforeach
@endif
 <div class="container" style="max-width:800px;">
   <h1>{{__('Members in schedule')}}: {{$schedule->name}}</h1>
   <span class="link_text">{{__('Show')}}:</span>
   <div id="connected_div" style="display:inline;">
      <a class="btn btn-link" id="connected_rb"  href="{{route('schedule.showMembers',['scheduleId' => $schedule->id])}}">{{__('Connected members')}}</a>
   </div>
   <div id="not_connected_div" style="display:inline;">
      <a class="btn btn-link" id="not_connected_rb"  href="{{route('schedule.showNotConnectedMembers',['scheduleId' => $schedule->id])}}">{{__('Not connected members')}}</a>
   </div>
   <div id="new_member_div" style="display:inline;">
      <a class="btn btn-link" id="new_member_rb"  href="{{route('schedule.showViewAdminRegisterMember',['scheduleId' => $schedule->id])}}">{{__('Register new member')}}</a>
   </div>
   <br>
   
   {{-- Show Form with table with not connected members (default) --}}
      <form action="{{ route('schedule.connectMember')}}" method="POST" id="addMemberForm" >
         <fieldset>
         
         <x-member-table 
            legendTitle="{{__('Not connected members')}}"
            connected="no"
            :schedule="$schedule"
            :vMemberSchedules="$nonMembers"   />
         <x-submit-button submitText="{{__('(Update and) connect checked mebers')}}"
            cancelText="{{ __('Cancel')}}"
            cancelUrl="{{route('schedule.index', ['scheduleId' => $schedule->id])}}"
            myId="connectButton"
            submit-disabled="disabled"
            onclickFunction="return true" />
     </fieldset>
     </form> 
   
 
 </div>
@section('scripts')
<script>

//Change text on submit button if members are marked for removal
function fixConnectButton(e) {
      var n= countConnects();
      console.log(n + ' connects');
      const connectButton = document.getElementById("connectButton");
      if (n===0) {
         connectButton.disabled= true;
      } else {
         connectButton.disabled= false;
      }
   };

function countConnects() {
   var checkBoxes=  document.querySelectorAll('.cbConnect');
   let n=0;
   for (let i = 0; i < checkBoxes.length; i++) {
      if (checkBoxes[i].checked) {
         n++;
      }
   }
   return n;
};
</script>


@endsection

@endsection
