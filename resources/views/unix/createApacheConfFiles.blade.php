@extends('layouts.app')
@section('content')

 <div class="container">
     <br>
     @if ($fileName1 != '')
     Configuration file {{$fileName1}} created
     <br>
     @endif
     @if ($fileName2 != '')
     Configuration file {{$fileName2}} created
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
     
 </div>
<!--</div>-->
@section('scripts')
<script>
     
</script>
@endsection

@endsection
