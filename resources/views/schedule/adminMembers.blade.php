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
   
   {{-- Show form with connected members, email adresses for updating or removing  --}}
   <form action="{{ route('schedule.updateMember')}}" method="POST" id="updateMemberForm">
      <fieldset>
          <div>
          <fieldset>
          <div style="margin-bottom:5px;">
          {{__('E-mail addresses')}}:
         <a class="btn-link" id="copyButton" style="float:right;" onClick="copyEmailAdresses()"> {{__('Copy to clipboard')}}</a>
          </div>    
        
         <textarea class="form-control" style="background-color:#ccc" id="emailAdresses"  cols="70">{{$emails}}</textarea>
         </fieldset>
         </div>
         
          <br>
         <x-member-table
            legendTitle="{{__('Connected members')}}"
            connected="yes"
            :schedule="$schedule"
            :vMemberSchedules="$vMemberSchedules"   />
         <x-submit-button submitText="{{__('Update')}}"
                   cancelText="{{ __('Cancel')}}"
                   cancelUrl="{{route('schedule.index', ['scheduleId' => $schedule->id])}}"
                   myId="submitButton"
                   onclickFunction="return checkDeletes()" />
      </fieldset>
      </form> 
   
 
 </div>
@section('scripts')
<script>
// Detect changes in input fields
   $("input").on("change keyup paste", function(){
    checkForm(1);
});

window.onload = function() {
  const submitButton = document.getElementById("submitButton");
  submitButton.disabled = true;
  checkForm();

};
function copyEmailAdresses() {
    $("#emailAdresses").select();
    document.execCommand('copy');
    alert("{{__('Email adresses copied to clipboard')}}");

}
function checkForm(status=0) {
   checkUniqueNames();
   fixSubmitButton(status);
}
function adminClicked(e) {
   var n=countAdmins();
   if (n===0) {
      e.target.checked= true;
      alert("{{__('You must have at least one admin in each schedule')}}");
   } else {
       submitButton.disabled = false;
   }
}

//Change text on submit button if members are marked for removal
function fixSubmitButton(status=0) {
   const submitButton = document.getElementById("submitButton");
   if (status > 0) {
      submitButton.disabled = false;
   }
      var n= countDeletes();
//      console.log('status='+status + ', ' + n + ' deletes');
      if (n===0) {
         submitButton.textContent  ="{{__('Update')}}";
      } else {
         submitButton.textContent  ="{{__('(Update and) remove checked mebers from schedule')}}";
      }
   };
   
function checkUniqueNames() {
   var elements = document.getElementById("updateMemberForm").elements;
   alert("checkUniqueNames not implemented ");
   for (var i = 0, element; element = elements[i++];) {
       if (element.type === "text" && element.value === "")
           console.log("it's an empty textfield")
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
   submitButton.disabled = false;
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
