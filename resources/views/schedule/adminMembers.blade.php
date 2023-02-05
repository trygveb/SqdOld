@extends('schedule.layout')
@section('menu1')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
<h1>{{__('Members in schema')}}: {{$schedule->name}}</h1>
 <div class="container">
   {{__('Show')}}: 
   <input type="radio" id="connected" name="show" value="connected" checked onclick="showClicked(event)">
   <label for="connected">{{__('Connected members')}}</label>
   <input type="radio" id="not_connected" name="show" value="not_connected" onclick="showClicked(event)">
   <label for="not_connected">{{__('Not connected members')}}</label>
   <input type="radio" id="new_member" name="show" value="new_member" onclick="showClicked(event)">
   <label for="new_member">{{__('Register and connect new member')}}</label>  
   
   {{-- Table with connected members --}}
   <form action="{{ route('schedule.updateMember')}}" method="POST" id="updateMemberForm">
      <fieldset>
         <label for="emailAdresses">{{__('E-mail addresses: (select all and copy)')}}</label>
         <br>
         <textarea style="background-color:#ccc" id="emailAdresses"  cols="70">{{$emails}}</textarea>
         <br>
         
         <x-member-table legendTitle="{{__('Connected members')}}"
                         connected="yes"
                         :schedule="$schedule"
                         addRemoveTitle="{{__('Remove')}}"
                         :vMemberSchedules="$vMemberSchedules"   />
         <x-submit-button submitText="{{__('Update')}}"
                   cancelText="{{ __('Cancel')}}"
                   cancelUrl="{{route('schedule.index', ['scheduleId' => $schedule->id])}}"
                   myId="removeButton"
                   onclickFunction="return checkDeletes()" />
      </fieldset>
      </form> 
   
      <form action="{{ route('schedule.updateMember')}}" method="POST" id="newMemberForm" style="display:none;">

      <a  href="{{ route('schedule.showRegisterUser',['scheduleId' => $schedule->id])}}">{{__('Register new member and connect to this schema')}}</a>
      </form>
   
      {{-- Table with not connected members --}}
      <form action="{{ route('schedule.connectMember')}}" method="POST" id="addMemberForm" style="display:none;">
         <fieldset>
         
         <x-member-table legendTitle="{{__('Not connected members')}}"
                         connected="no"
                         :schedule="$schedule"
                         addRemoveTitle="{{__('Connect')}}"
                         :vMemberSchedules="$nonMembers"   />
         <x-submit-button submitText="{{__('Update')}}"
                   cancelText="{{ __('Cancel')}}"
                   cancelUrl="{{route('schedule.index', ['scheduleId' => $schedule->id])}}"
                   myId="removeButton"
                   onclickFunction="return true" />
     </fieldset>
     </form> 
         
 
 </div>
@section('scripts')
<script>
window.onload = function() {
      document.getElementById("connected").checked= true;
};
function adminClicked(e) {
   var n=countAdmins();
   if (n===0) {
      e.target.checked= true;
      alert("{{__('You must have at least one admin in each schedule')}}");
   }
}
function showClicked(e) {
   if (e.target.id=="connected") {
      document.getElementById("addMemberForm").style.display = "none";
      document.getElementById("updateMemberForm").style.display = "block";
      document.getElementById("newMemberForm").style.display = "none";
   } else if (e.target.id=="not_connected") {
      document.getElementById("addMemberForm").style.display = "block";
      document.getElementById("updateMemberForm").style.display = "none";
      document.getElementById("newMemberForm").style.display = "none";
   } else if (e.target.id=="new_member") {
      document.getElementById("addMemberForm").style.display = "none";
      document.getElementById("updateMemberForm").style.display = "none";
      document.getElementById("newMemberForm").style.display = "block";
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
      var checkBoxes=  document.querySelectorAll('.cbAction');
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
