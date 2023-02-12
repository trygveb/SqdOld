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
   
   
   {{-- Show Register new member form --}}
      <div id="newMemberForm">
      <x-registration-form
          :names="$names"
          isAdmin="1" />
      </div>
   
         
 
 </div>
@section('scripts')
<script>

function checkForm() {
   document.getElementById("name").value=document.getElementById("first_name").value + ' ' +
              document.getElementById("middle_name").value +' ' + document.getElementById("family_name").value   
}

</script>


@endsection

@endsection
