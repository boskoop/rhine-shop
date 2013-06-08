{{--
    account_editprofile.blade.php

    Variables needed:
    - username -> the username
    - emain -> the email
--}}
            <h2>{{ __('rhine/account.edit_profile') }}</h2>
            {{ Form::open(URL::to_route('saveprofile'), 'POST', array('class' => 'form-horizontal')) }}

              <div class="control-group{{ $errors->has('username') ? ' error' : '' }}">
                <label class="control-label" for="username">{{ __('rhine/account.username') }} <span class="mandatory">*</span></label>
                <div class="controls">
                  <input type="text" id="username" name="username" placeholder="{{ __('rhine/account.username') }}" value="{{ $username }}" required>
@if($errors->has('username'))
                  <span class="help-inline">{{ $errors->first('username') }}</span>
@endif
                </div>
              </div>
              <div class="control-group{{ $errors->has('email') ? ' error' : '' }}">
                <label class="control-label" for="email">{{ __('rhine/account.email') }} <span class="mandatory">*</span></label>
                <div class="controls">
                  <input type="email" id="email" name="email" placeholder="{{ __('rhine/account.email') }}" value="{{ $email }}" required>
@if($errors->has('email'))
                  <span class="help-inline">{{ $errors->first('email') }}</span>
@endif
                </div>
              </div>
              <hr>
              <div class="control-group{{ $errors->has('old_password') ? ' error' : '' }}">
                <label class="control-label" for="old_password">{{ __('rhine/account.old_password') }}</label>
                <div class="controls">
                  <input type="password" id="old_password" name="old_password" placeholder="{{ __('rhine/account.old_password') }}">
@if($errors->has('old_password'))
                  <span class="help-inline">{{ $errors->first('old_password') }}</span>
@endif
                  <span class="help-block">{{ __('rhine/account.leave_empty') }}</span>
                </div>
              </div>
              <div class="control-group{{ $errors->has('password') ? ' error' : '' }}">
                <label class="control-label" for="password">{{ __('rhine/account.new_password') }}</label>
                <div class="controls">
                  <input type="password" id="password" name="password" placeholder="{{ __('rhine/account.new_password') }}">
@if($errors->has('password'))
                  <span class="help-inline">{{ $errors->first('password') }}</span>
@endif
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="password_confirmation">{{ __('rhine/account.confirm') }}</label>
                <div class="controls">
                  <input type="password" id="password_confirmation" name="password_confirmation" placeholder="{{ __('rhine/account.confirm') }}">
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-primary">{{ __('rhine/account.save') }}</button>
                {{ HTML::link_to_route('profile', __('rhine/account.cancel'), array(), array('class' => 'btn')) }}

              </div>
              {{ Form::token() }}

            {{ Form::close() }}

