@extends('schedule.layout')

@section('menu1')
@if ($scheduleAdmin )
   <x-schedule-admin-menu schedule-id="{{$schedule->id}}"  user-id="{{$currentUser->id}}"/>
@endif
@endsection
@section('content')
<h1>{{__('Schedule for')}} {{$schedule->name}}
@endsection
@section('scripts')
<script>
window.onload = function() {
  document.getElementsByTagName("title")[0].innerHTML="SdSchema {{$schedule->name}}";
};
const historyCheckbox = document.getElementById('show_history')

historyCheckbox.addEventListener('change', (event) => {
  if (event.currentTarget.checked) {
      location.href = "{{route('schedule.index',['scheduleId' => $schedule->id, 'showHistory' => 1])}}";
  } else {
      location.href = "{{route('schedule.index',['scheduleId' => $schedule->id, 'showHistory' => 0])}}";
  }
})
</script>
@endsection