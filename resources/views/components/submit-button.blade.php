<p style="float:left;">
<button type="submit" class="btn btn-primary" id="{{$myId ?? ''}}" onclick="{{$onclickFunction ?? ''}}" > 
    {{$submitText}} 
</button>
<a style="margin-left:5px;" href="{{$cancelUrl}}" class="btn btn-secondary"> {{$cancelText}}</a>
</p>
