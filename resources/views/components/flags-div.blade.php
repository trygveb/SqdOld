<div class="flags">
@if ( LaravelLocalization::getCurrentLocale()=="en")
   <a href="{{ LaravelLocalization::getLocalizedURL('se', null, [], true) }}"> {{country_flag('SE');}}</a>
@else
   <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"> {{country_flag('GB');}}</a>
@endif   
</div>
