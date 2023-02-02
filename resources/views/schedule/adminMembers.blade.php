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
<h1>{{__('Members')}}</h1>
 <div class="container">
      <label for="emailAdresses">{{__('E-mail addresses: (select all and copy)')}}</label><br>
      <textarea style="background-color:#ccc" id="emailAdresses"  cols="80">{{$emails}}</textarea>
     <br>
      <form action="{{ route('schedule.updateMember')}}" method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="scheduleId" value="{{$schedule->id}}">

          {{-- Table with connected members --}}

          <fieldset>
            <legend>{{__('Members in schema')}} <span style="white-space: nowrap;">{{$schedule->name}}</span></legend>
           <table class="table table-bordered table-sm" style="max-width:250px;">
               <thead style="font-weight:bold; text-decoration-line: underline;">
               <th class="text-nowrap">{{__('Name')}}</th>
               <th class="text-nowrap">Admin</th>
               <th class="text-nowrap text-center" style="padding:2px 5px 2px 5px;">{{__('Remove')}}</th>
               </thead>
               <tbody>
         @foreach ($vMemberSchedules as $member)
            @php
               $deleteName='delete_'.$member->user_id;
               $adminName='admin_'.$member->user_id;
            @endphp
                  <tr class='status'>
                     <td class="text-nowrap" >{{$member->user_name}}</td>
                     <td style="padding:2px 5px 2px 5px;" class="text-center">
                     @if ($member->admin == 1)
                        <input type="checkbox"  class="cbAdmin"  name="{{$adminName}}" onclick="adminClicked(event)" checked>
                     @else
                        <input type="checkbox"  class="cbAdmin"  name="{{$adminName}}" onclick="adminClicked(event)">
                     @endif
                     </td>
                     <td class="text-nowrap text-center" style="padding:2px 5px 2px 5px;">
                         <input type="checkbox"  class="cbRemove"  name="{{$deleteName}}">
                     </td>
                  </tr>
         @endforeach
               </tbody>
            </table>
            <br>

            <x-submit-button submitText="{{__('Update')}}"
                             cancelText="{{ __('Cancel')}}"
                             cancelUrl="{{route('schedule.index', ['scheduleId' => $schedule->id])}}"
                             myId="removeButton"
                             onclickFunction="return checkDeletes()" />
         </fieldset>

         <a  href="{{ route('schedule.showRegisterUser',['scheduleId' => $schedule->id])}}">{{__('Register new member and connect to schema')}}</a>

         {{-- Table with not connected members --}}

         <fieldset>
         <legend>{{__('Registered members not connected to schema')}} <span style="white-space: nowrap;">{{$schedule->name}}</span></legend>
         <table class="table table-bordered table-sm" style="max-width:250px;">
            <thead style="font-weight:bold; text-decoration-line: underline;">
            <th class="text-nowrap">{{__('Name')}}</th>
            <th class="text-nowrap">Admin</th>
            <th class="text-nowrap text-center" style="padding:2px 5px 2px 5px;">{{__('Add')}}</th>
            </thead>
            <tbody>
         @foreach ($nonMembers as $member)
         @php
            $addName='add_'.$member->user_id;
            $adminName='admin_'.$member->user_id;
         @endphp
               <tr class='status'>
                  <td class="text-nowrap" >{{$member->user_name}}</td>
                  <td style="padding:2px 5px 2px 5px;" class="text-center">
                  <input type="checkbox"  class="cbAdmin"  name="{{$adminName}}" onclick="adminClicked(event)">
                  </td>
                  <td class="text-nowrap text-center" style="padding:2px 5px 2px 5px;">
                        <input type="checkbox"  class="cbAdd"  name="{{$addName}}">
                  </td>
               </tr>
         @endforeach
            </tbody>
         </table>
         <br>
          <x-submit-button submitText="{{__('Update')}}"
                             cancelText="{{ __('Cancel')}}"
                             cancelUrl="{{route('schedule.index', ['scheduleId' => $schedule->id])}}"
                             myId="removeButton"
                             onclickFunction="return checkDeletes()" />
         </fieldset>



     </form>
 </div>
@section('scripts')
<script>
window.onload = function() {
//   hideOrShowRemoveButton();
//   hideOrShowAddButton();
};
function adminClicked(e) {
   var n=countAdmins();
   if (n===0) {
      e.target.checked= true;
      alert("{{__('You must have at least one admin in each schedule')}}");
   }
}
//Disable Remove button if no member is marked for removal
function hideOrShowRemoveButton() {
      var n= countDeletes();
      //console.log(n + ' deletes');
      const removeButton = document.getElementById("removeButton");
      if (n===0) {
         // removeButton.style.display = "none";
         removeButton.disabled=true;
      } else {
         removeButton.disabled=false;
          //removeButton.style.display = "inline-block";      
      }
   };
   

   function countAdmins() {
      var checkBoxes=  document.querySelectorAll('.cbAdmin');
      let n=0;
      for (let i = 0; i < checkBoxes.length; i++) {
         if (checkBoxes[i].checked) {
            n++;
         }
      }
      return n;
   };
   function countDeletes() {
      var checkBoxes=  document.querySelectorAll('.cbRemove');
      let n=0;
      for (let i = 0; i < checkBoxes.length; i++) {
         if (checkBoxes[i].checked) {
            n++;
         }
      }
      return n;
   };
   
   function checkDeletes() {
      var n= countDeletes();
      if (n> 0 ) {
         return confirm("{{__('Are you sure? You have selected')}} "+n+" {{__('members for removal')}}.\n\
{{__('This can not be undone. If the member wants to join again later, he/she must register again')}}");
      } else {
         return true;
      }
   };
function copyEmails() {
  /* Get the text field */
  var copyText = document.getElementById("emailAdresses");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

   /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
} 
</script>


@endsection

@endsection
