@extends('layouts.app')
@section('content')
<h1>Medlemmar</h1>
 <div class="container">
      <label for="emailAdresses">Emailadresser: (markera alla och kopiera)</label><br>
      <textarea style="background-color:#ccc" id="emailAdresses"  cols="80">{{$emails}}</textarea>
     <br>
      <form action="{{ route('sdSchema.addMember')}}" method="POST">
          {{ csrf_field() }}
         <input type="hidden" name="trainingId" value="{{$training->id}}">t
         <fieldset>
             <legend>Ange medlem som skall läggas till schemat <span style="white-space: nowrap;">{{$training->name}}</span></legend>
            <br>
            <div class="table-responsive" style="overflow-x:auto; overflow-y:hidden;">
      @if (count($nonMembers) > 0)
         <table class="table table-bordered table-sm" style="max-width:500px;"> 
            <thead style="font-size:1.3em;font-weight:bold; text-decoration-line: underline;">
               <th>Namn</th>
               <th>epost</th>
               <th>Antal</th>
               <th class="text-nowrap text-center">Behörighet</th>
               <th  class="text-center" style="max-width:80px;">Lägg till</th>
            </thead>
            <tbody>
         @foreach  ($nonMembers as $member)
         @php
            $addName='add_'.$member->id;
         @endphp

               <tr>
                  <td class="text-nowrap">{{$member->name}}</td>
                  <td class="text-nowrap">{{$member->email}}</td>
                  <td class="text-center">{{$member->group}}</td>
                  <td class="text-center">{{$member->authority}}</td>
                  <td style="padding:2px 5px 2px 5px;" class="text-center">
                      <input type="checkbox"  class="cbAdd" onclick="hideOrShowAddButton()" name="{{$addName}}"></td>
               </tr>
         @endforeach
            </tbody>
         </table>
      @else
         Alla registrerade användare är redan anslutna till <span style="white-space: nowrap;">{{$training->name}}</span>.
      @endif
            </div>
            <br>
            <p style="float:right;">
               <button type="submit" class="btn btn-primary" id="addButton" style="margin-right:10px;">Lägg till markerade</button>
               <a href="{{route('sdSchema.showRegisterUser',['trainingId' => $training->id])}}" class="btn btn-primary" role="button">
               Registrera ny användare
               </a>
               
            </p>
         </fieldset>
      </form>
      <br>
      <form action="{{ route('sdSchema.removeMember')}}" method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="trainingId" value="{{$training->id}}">
          <fieldset>
            <legend>Markera medlem som skall tas bort från schemat <span style="white-space: nowrap;">{{$training->name}}</span></legend>
           <table class="table table-bordered table-sm" style="max-width:250px;">
               <thead style="font-size:1.3em;font-weight:bold; text-decoration-line: underline;">
               <th class="text-nowrap">Namn</th>
               <th class="text-nowrap text-center" style="padding:2px 5px 2px 5px;">Ta bort</th>
               </thead>
               <tbody>
         @foreach ($members as $member)
            @php
               $deleteName='delete_'.$member->user_id;
            @endphp
                  <tr class='status'>
                     <td class="text-nowrap" >{{$member->user_name}}</td>
                     <td class="text-nowrap text-center" style="padding:2px 5px 2px 5px;">
                         <input type="checkbox"  class="cbRemove" onclick="hideOrShowRemoveButton()" name="{{$deleteName}}">
                     </td>
                  </tr>
         @endforeach
               </tbody>
            </table>
            <br>
            <p style="float:right;">
            <button type="submit" class="btn btn-primary" style="margin-right:10px;" id="removeButton" onclick="return checkDeletes()">Ta bort medlem</button>
          </p>

         </fieldset>

     </form>
 </div>
@section('scripts')
<script>
 
window.onload = function() {
   hideOrShowRemoveButton();
   hideOrShowAddButton();
};
//Hide Remove button if no member is marked for removal
function hideOrShowRemoveButton() {
      var n= countDeletes();
      console.log(n + ' deletes');
      const removeButton = document.getElementById("removeButton");
      if (n==0) {
          removeButton.style.display = "none";      
      } else {
          removeButton.style.display = "inline-block";      
      }
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
         return confirm('Är du säker? Du har markerat '+n+' medlemmar för borttag.');
      } else {
         return true;
      }
   };
//Hide Add button if no user is marked for adding
function hideOrShowAddButton() {
      var n= countAdds();
       console.log(n + ' adds');
      const addButton = document.getElementById("addButton");
      if (n==0) {
          addButton.style.display = "none";      
      } else {
          addButton.style.display = "inline-block";      
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
