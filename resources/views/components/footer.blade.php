<footer class="footer">
  <div class="container" style="text-align:center;  padding-bottom:20px;">
     @if ($subApp=='sqd.se') 
    <span class="text-muted" >{{$subApp}} &nbsp;@include('version',[])&nbsp;&nbsp;(@include('versionTime',[]))</span>
    @elseif ($subApp=='sdCalls')
    <span class="text-muted" >{{$subApp}} &nbsp;@include('calls.version',[])&nbsp;&nbsp;(@include('calls.versionTime',[]))</span>
    @else
    <span class="text-muted" >{{$subApp}} &nbsp;@include('schema.version',[])&nbsp;&nbsp;(@include('schema.versionTime',[]))</span>
    @endif
    
  </div>
</footer>  
