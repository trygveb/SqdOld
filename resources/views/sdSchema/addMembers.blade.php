@extends('sdSchema.layout')
@section('menu1')
@if ($admin > 0)
   <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Administration
   </a>
   <div class="dropdown-menu" aria-labelledby="navbarDropdown">
   <a class="dropdown-item" href="{{route('sdSchema.showComments',['trainingId' => $training->id])}}">{{__('Manage comments')}}</a>
   <a class="dropdown-item" href="{{route('sdSchema.showAddRemoveDates',['trainingId' => $training->id])}}">{{__('Manage dates')}}</a>
   </div>
@endif
@endsection
@section('content')
<h1>{{__('Add Members')}} NOT USED</h1>
 <div class="container">
      <label for="emailAdresses">{{__('E-mail addresses: (select all and copy)')}}</label><br>
      <textarea style="background-color:#ccc" id="emailAdresses"  cols="80">{{$emails}}</textarea>
     <br>
      <form action="{{ route('sdSchema.addMember')}}" method="POST">
          {{ csrf_field() }}
         <input type="hidden" name="trainingId" value="{{$training->id}}">
         <fieldset>
             <legend>{{__('Check members to be added to schedule')}}: <span style="white-space: nowrap;">{{$training->name}}</span></legend>
            <br>
            <div class="table-responsive" style="overflow-x:auto; overflow-y:hidden;">
      @if (count($nonMembers) > 0)
         <table class="table table-bordered table-sm" style="max-width:500px;"> 
            <thead style="font-size:1em;font-weight:bold; text-decoration-line: underline;">
               <th>{{__('Name')}}</th>
               <th>{{__('E-Mail')}}</th>
               <th>{{__('Group-size')}}</th>
               <th class="text-nowrap text-center">Admin</th>
               <th  class="text-center" style="max-width:80px;">Lägg till</th>
            </thead>
            <tbody>
         @foreach  ($nonMembers as $member)
         @php
            $addName='add_'.$member->user_id;
            $adminName='admin_'.$member->user_id;
         @endphp

               <tr>
                  <td class="text-nowrap">{{$member->user_name}}</td>
                  <td class="text-nowrap">{{$member->email}}</td>
                  <td class="text-center">{{$member->group}}</td>
                  <td style="padding:2px 5px 2px 5px;" class="text-center">
                  <input type="checkbox"  class="cbAdd" name="{{$adminName}}">
                  </td>
                  <td style="padding:2px 5px 2px 5px;" class="text-center">
                      <input type="checkbox"  class="cbAdd" onclick="hideOrShowAddButton()" name="{{$addName}}">
                  </td>
               </tr>
         @endforeach
            </tbody>
         </table>
      @else
         {{__('All registered users are already connected to')}} <span style="white-space: nowrap;">{{$training->name}}</span>.
      @endif
            </div>
            <br>
            <x-submit-button
                submitText="{{__('Add checked')}}"
                cancelText="{{ __('Cancel')}}"
                myId="addButton"
                cancelUrl="{{route('sdSchema.index')}}" />
         </fieldset>
      </form>
 </div>
@section('scripts')
<script>
 
window.onload = function() {
   hideOrShowRemoveButton();
   hideOrShowAddButton();
};
/
 //Disable Add button if no user is marked for adding
function hideOrShowAddButton() {
      var n= countAdds();
   //    console.log(n + ' adds');
      const addButton = document.getElementById("addButton");
      if (n===0) {
          addButton.disabled=true;     
      } else {
          addButton.disabled=false;     
      }
   };
  function countAdds() {
      var checkBoxes=  document.querySelectorAll('.cbAdd');
      let n=0;
      for (let i = 0; i < checkBoxes.length; i++) {
         if (checkBoxes[i].checked) {
            n++;
         }
      }
      return n;
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
