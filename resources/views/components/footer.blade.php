<footer class="footer">
  <div class="container" style="text-align:center;  padding-bottom:20px;">
     @if ($subApp=='sqd.se') 
    <span class="text-muted" >{{$subApp}} &nbsp;@include('version',[])&nbsp;&nbsp;(@include('versionTime',[]))</span>
    @elseif ($subApp=='sdCalls')
    <span class="text-muted" >{{$subApp}} &nbsp;@include('sdCalls.version',[])&nbsp;&nbsp;(@include('sdCalls.versionTime',[]))</span>
    @else
    <span class="text-muted" >{{$subApp}} &nbsp;@include('schedule.version',[])&nbsp;&nbsp;(@include('schedule.versionTime',[]))</span>
    @endif
@include('cookieConsent::index')
  </div>
</footer>  
