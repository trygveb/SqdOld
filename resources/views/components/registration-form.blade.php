      <div>
         <form method="POST" id="theForm" action="{{ route('handleRegistration') }}">
             @csrf
             <input type="hidden" name="application" value="{{$names['application']}}" />
             <!-- isAdmin is true if an administrator adds the member -->
             <input type="hidden" name="isAdmin" value="{{$isAdmin}}" />
             <div class="form-group row">
                 <label for="name" class="col-md-4 col-form-label text-md-right" style="max-width:75px;">{{ __('Name') }}</label>

                 <div class="col-md-6">
                     <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            style="max-width:150px;" value="{{ old('name') }}" required autocomplete="name" autofocus>

                     @error('name')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                 </div>
             </div>

             <div class="form-group row">
                 <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                 <div class="col-md-6">
                     <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                     @error('email')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                 </div>
             </div>

             <div class="form-group row">
                 <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                 <div class="col-md-6">
                     <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                     @error('password')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                 </div>
             </div>

             <div class="form-group row">
                 <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                 <div class="col-md-6">
                     <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                 </div>
             </div>
             @empty($isAdmin)
             <div class="form-group row">
                 <label for="privacy_confirm" class="col-md-4 col-form-label text-md-right"></label>
                 <div class="col-md-6">
                    <input id="privacy_confirm" type="checkbox" onclick="checkForm();"  name="privacy_confirmation" >
                    {{ __('I have read the')}}  <a href="{{route('privacy')}}" " >{{ __('Privacy policy')}}</a>
                 </div>
             </div>
             @else
             <div class="form-group row">
                 <label for="group_size" class="col-md-4 col-form-label text-md-right">{{ __('Group-size') }}</label>
                 <div class="col-md-6">
                    <input id="group_size" type="number" size="3" min="1" max="2" name="group_size" >
                 </div>
             </div>

             @endempty
             <div class="form-group row mb-0">
                 <div class="col-md-6 offset-md-4">
                      <p style="float:right;">
                      @empty($isAdmin)
                      <button type="submit" disabled="disabled" class="btn btn-primary" id="submit-button" >{{ __('Register')}}</button>
                      @else
                      <button type="submit" disabled="enabled" class="btn btn-primary" id="submit-button" >{{ __('AdminRegister')}}</button>
                      @endempty
                      <a style="margin-left:5px;" href="{{route($names['routeRoot'].'.home')}}" class="btn btn-secondary"> {{ __('Cancel')}}</a>
                      </p>
                 </div>
             </div>
         </form>
     </div>
    <br>
    {{__(config('app.passwordFormat1'))}}<br>
    <ol>
        <li>{{__(config('app.passwordFormat2'))}}</li>
       <li>{{__(config('app.passwordFormat3'))}}</li>
       <li>{{__(config('app.passwordFormat4'))}}</li>
    </ol>

