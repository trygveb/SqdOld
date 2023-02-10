      <div>
         <form method="POST" id="theForm" action="{{ route('handleRegistration') }}">
            <fieldset style="max-width:550px;">
             @csrf
             <input type="hidden" name="application" value="{{$names['application']}}" />
             <!-- isAdmin is true if an administrator adds the member -->
             <input type="hidden" name="isAdmin" value="{{$isAdmin}}" />
              <!-- name is created on submit click -->
             <input type="hidden" name="name" id="name" />
             <legend id="legend">{{__('Register new member')}}</legend>
             <div class="form-group row">
                 <label for="first_name" class="label_name_input col-md-4 col-form-label text-md-right" >{{ __('First name') }} *</label>
                 <div class="col-md-6">
                     <input id="first_name" type="text" class="name_input form-control @error('name') is-invalid @enderror" name="first_name"
                             value="{{ old('first_name') }}" maxlength="24" required  autofocus>
                     @error('name')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                 </div>
             </div>
             <div class="form-group row">
                 <label for="middle_name" class="label_name_input col-md-4 col-form-label text-md-right">{{ __('Middle name') }}</label>
                 <div class="col-md-6">
                     <input id="middle_name" type="text" class="name_input form-control @error('name') is-invalid @enderror" name="middle_name"
                             value="{{ old('middle_name') }}" maxlength="24" autofocus>
                     @error('name')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                 </div>
             </div>

             <div class="form-group row">
                 <label for="family_name" class="label_name_input col-md-4 col-form-label text-md-right" >{{ __('Family name') }} *</label>
                 <div class="col-md-6">
                     <input id="family_name" type="text" class="name_input form-control @error('family_name') is-invalid @enderror" name="family_name"
                             value="{{ old('family_name') }}" maxlength="24" required  autofocus>
                     @error('name')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                 </div>
             </div>
             <div class="form-group row">
                 <label for="email" class="label_name_input col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} *</label>

                 <div class="col-md-6">
                     <input id="email" type="email" class="name_input form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required maxlength="64"  autocomplete="email">

                     @error('email')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                 </div>
             </div>

             <div class="form-group row">
                 <label for="password" class="label_name_input col-md-4 col-form-label text-md-right">{{ __('Password') }} *</label>

                 <div class="col-md-6">
                     <input id="password" type="password" class="name_input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                     @error('password')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                 </div>
             </div>

             <div class="form-group row">
                 <label for="password-confirm" class="label_name_input col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }} *</label>

                 <div class="col-md-6">
                     <input id="password-confirm" type="password" class="name_input form-control" name="password_confirmation" required autocomplete="new-password">
                 </div>
             </div>
             @empty($isAdmin)
             <div class="form-group row">
                 <label for="privacy_confirm" class="label_name_input col-md-4 col-form-label text-md-right"></label>
                 <div class="col-md-6">
                    <input id="privacy_confirm" type="checkbox" onclick="checkForm();"  name="privacy_confirmation" >
                    {{ __('I have read the')}}  <a href="{{route('privacy')}}" " >{{ __('Privacy policy')}}</a>
                 </div>
             </div>
             @else
             <div class="form-group row">
                 <label for="group_size" class="label_name_input col-md-4 col-form-label text-md-right">{{ __('Group-size') }} *</label>
                 <div class="col-md-6">
                    <input id="group_size" type="number" size="3" min="1" max="2" value="1" name="group_size" >
                 </div>
             </div>
             @endempty
             * {{__('Required fields')}}
             <div class="form-group row mb-0">
                 <div class="col-md-6 offset-md-4">
                      <p style="float:right;">
                      @empty($isAdmin)
                      <button type="submit"  onclick="checkForm() class="btn btn-primary" id="submit-button" >{{ __('Register')}}</button>
                      @else
                      <button type="submit"  class="btn btn-primary" id="submit-button" >{{ __('AdminRegister')}}</button>
                      @endempty
                      <a style="margin-left:5px;" href="{{route($names['routeRoot'].'.home')}}" class="btn btn-secondary"> {{ __('Cancel')}}</a>
                      </p>
                 </div>
             </div>
                 <br>
    {{__(config('app.passwordFormat1'))}}<br>
    <ol>
        <li>{{__(config('app.passwordFormat2'))}}</li>
       <li>{{__(config('app.passwordFormat3'))}}</li>
       <li>{{__(config('app.passwordFormat4'))}}</li>
    </ol>

            </fieldset>
         </form>
     </div>

