@extends('layouts.app')
@section('content')

 <div class="container">
     <br>
     @if ($fileName1 != '')
     Configuration file {{$fileName1}} created
     <br>
     @endif
     @if ($fileNameSSL != '')
     Configuration file {{$fileNameSSL}} created    
     <br>sudo a2ensite {{$subDomain}}
     <br>sudo apachectl configtest
     <br>sudo systemctl reload apache2
     <br><br>
     @endif
   <fieldset>
   <legend>Create Apache config files</legend>
      <form action="{{ route('createConfigFiles')}}"  method="POST">
            {{ csrf_field() }}
        <div class="form-group">
          <label for="subDomain">Subdomain</label>
          <input type="text" class="form-control" name="subDomain" id="subDomain" placeholder="calls.sqd">
        </div>
        <div class="form-group">
          <label for="rootPath">Root path</label>
          <input type="text" class="form-control" name="rootPath" id="rootPath" placeholder="sd/calls">
        </div>
         <a href="" class="btn btn-primary" role="button" style="float:left;">Cancel</a>
         <button type="submit" class="btn btn-primary" style="float:right;">Create files</button>
      </form>   
   </fieldset>
     <br>
     <code>
   <br>sudo a2ensite subDomain
   <br>sudo apachectl configtest
   <br>sudo a2dissite subDomain
   <br>sudo systemctl reload apache2
   <br>sudo systemctl status apache2.service
   <br>sudo journalctl -xe
     </code>
 </div>
<!--</div>-->
@section('scripts')
<script>
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

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
