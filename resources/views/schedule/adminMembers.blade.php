@extends('schedule.layout')
@section('menu1')

@if (array_count_values($status) > 0)
       @foreach ($status as $key => $value)
          @if ($key=='target') 
             @if ($value=='updateMember')
             @endif
          @endif
             @if (str_contains($key,'error')) 
             <div class="alert alert-danger">
              {{ $value }}</li>
             </div>
             @endif
       @endforeach
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
 <div class="container" style="max-width:800px;">
   <h1>{{__('Members in schedule')}}: {{$schedule->name}}</h1>
   <span class="link_text">{{__('Show')}}:</span>
   <div id="connected_div" style="display:inline;">
      <a class="btn btn-link" id="connected_rb"  onclick="showClicked(event)">{{__('Connected members')}}</a>
   </div>
   <div id="not_connected_div" style="display:none;">
      <a class="btn btn-link" id="not_connected_rb"  onclick="showClicked(event)">{{__('Not connected members')}}</a>
   </div>
   <div id="new_member_div" style="display:inline;">
      <a class="btn btn-link" id="new_member_rb"  onclick="showClicked(event)">{{__('Register new member')}}</a>
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
   
   {{-- Show form with connected members, email adresses for updating or removing  --}}
   <form action="{{ route('schedule.updateMember')}}" method="POST" id="updateMemberForm" style="display:none;">
      <fieldset>
         <label for="emailAdresses">{{__('E-mail addresses: (select all and copy)')}}</label>
         <br>
         <textarea style="background-color:#ccc" id="emailAdresses"  cols="70">{{$emails}}</textarea>
         <br>
         
         <x-member-table
            legendTitle="{{__('Connected members')}}"
            connected="yes"
            :schedule="$schedule"
            :vMemberSchedules="$vMemberSchedules"   />
         <x-submit-button submitText="{{__('Update')}}"
                   cancelText="{{ __('Cancel')}}"
                   cancelUrl="{{route('schedule.index', ['scheduleId' => $schedule->id])}}"
                   myId="removeButton"
                   onclickFunction="return checkDeletes()" />
      </fieldset>
      </form> 
   
   {{-- Show Register new member form --}}
      <div id="newMemberForm" style="display:none;">
      <x-registration-form
          :names="$names"
          isAdmin="1" />
      </div>
   
         
 
 </div>
@section('scripts')
<script>

window.onload = function() {
   document.getElementById("connectButton").disabled= true;
};

function checkForm() {
   document.getElementById("name").value=document.getElementById("first_name").value + ' ' +
              document.getElementById("middle_name").value +' ' + document.getElementById("family_name").value   
}
function adminClicked(e) {
   var n=countAdmins();
   if (n===0) {
      e.target.checked= true;
      alert("{{__('You must have at least one admin in each schedule')}}");
   }
}
function showClicked(e) {
   if (e.target.id=="connected_rb") {
      console.log('connected_rb');
      document.getElementById("addMemberForm").style.display = "none";
      document.getElementById("updateMemberForm").style.display = "block";
      document.getElementById("newMemberForm").style.display = "none";
      
      document.getElementById("connected_div").style.display = "none";
      document.getElementById("not_connected_div").style.display = "inline";
      document.getElementById("new_member_div").style.display = "inline";
   } else if (e.target.id=="not_connected_rb") {
      console.log("show clicked with target=not connected")
      notConnectedEventHandler();
   } else if (e.target.id=="new_member_rb") {
      console.log('new_member_rb');
      document.getElementById("addMemberForm").style.display = "none";
      document.getElementById("updateMemberForm").style.display = "none";
      document.getElementById("newMemberForm").style.display = "block";
      
      document.getElementById("connected_div").style.display = "inline";
      document.getElementById("not_connected_div").style.display = "inline";
      document.getElementById("new_member_div").style.display = "none";

   }
}

function notConnectedEventHandler() {
   document.getElementById("addMemberForm").style.display = "block";
   document.getElementById("updateMemberForm").style.display = "none";
   document.getElementById("newMemberForm").style.display = "none";
   
      document.getElementById("connected_div").style.display = "inline";
      document.getElementById("not_connected_div").style.display = "none";
      document.getElementById("new_member_div").style.display = "inline";
   
}

//Change text on submit button if members are marked for removal
function fixRemoveButton(e) {
      var n= countDeletes();
      console.log(n + ' deletes');
      const removeButton = document.getElementById("removeButton");
      if (n===0) {
         // removeButton.style.display = "none";
         removeButton.textContent  ="{{__('Update')}}";
      } else {
         removeButton.textContent  ="{{__('Remove checked mebers from schedule')}}";
          //removeButton.style.display = "inline-block";      
      }
   };
   
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
