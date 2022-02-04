<footer class="footer">
  <div class="container" style="text-align:center;  padding-bottom:20px;">
     @if ($subApp==='sqd.se') 
    <span class="text-muted" >sqd.se {{config('app.env')}}&nbsp;@include('version',[])&nbsp;&nbsp;(@include('versionTime',[]))</span>
    @elseif ($subApp=='sdCalls')
    <span class="text-muted" >sdCalls {{config('app.env')}}&nbsp;@include('sdCalls.version',[])&nbsp;&nbsp;(@include('sdCalls.versionTime',[]))</span>
    @else
    <span class="text-muted" >sdSchema {{config('app.env')}} &nbsp;@include('schedule.version',[])&nbsp;&nbsp;(@include('schedule.versionTime',[]))</span>
    @endif
@include('cookieConsent::index')
  </div>
</footer>  
