<p style="float:right;">
<button type="submit" class="btn btn-primary" id="{{$myId ?? ''}}" onclick="{{$onclickFunction ?? ''}}"
    @if($submitDisabled=="1") disabled='disabled' @endif
    > 
    {{$submitText}} 
</button>
<a style="margin-left:5px;" href="{{$cancelUrl}}" class="btn btn-secondary"> {{$cancelText}}</a>
</p>
