{{--
    account_sidenavigation.blade.php

    Variables needed:
    - username -> the username
    - emain -> the email
--}}
            <h2>Profile</h2>
            {{ Form::open(URL::to_route('saveprofile'), 'POST', array('class' => 'form-horizontal')) }}

              <div class="control-group{{ $errors->has('username') ? ' error' : '' }}">
                <label class="control-label" for="username">Username <span class="mandatory">*</span></label>
                <div class="controls">
                  <input type="text" id="username" name="username" placeholder="Username" value="{{ $username }}" required>
@if($errors->has('username'))
                  <span class="help-inline">{{ $errors->first('username') }}</span>
@endif
                </div>
              </div>
              <div class="control-group{{ $errors->has('email') ? ' error' : '' }}">
                <label class="control-label" for="email">Email <span class="mandatory">*</span></label>
                <div class="controls">
                  <input type="email" id="email" name="email" placeholder="Email" value="{{ $email }}" required>
@if($errors->has('email'))
                  <span class="help-inline">{{ $errors->first('email') }}</span>
@endif
                </div>
              </div>
              <hr>
              <div class="control-group{{ $errors->has('old_password') ? ' error' : '' }}">
                <label class="control-label" for="old_password">Old Password</label>
                <div class="controls">
                  <input type="password" id="old_password" name="old_password" placeholder="Old password">
@if($errors->has('old_password'))
                  <span class="help-inline">{{ $errors->first('old_password') }}</span>
@endif
                  <span class="help-block">Leave empty if you don't want to change the password</span>
                </div>
              </div>
              <div class="control-group{{ $errors->has('password') ? ' error' : '' }}">
                <label class="control-label" for="password">New Password</label>
                <div class="controls">
                  <input type="password" id="password" name="password" placeholder="New password">
@if($errors->has('password'))
                  <span class="help-inline">{{ $errors->first('password') }}</span>
@endif
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="password_confirmation">Confirm</label>
                <div class="controls">
                  <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm">
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save changes</button>
                {{ HTML::link_to_route('profile', 'Cancel', array() ,array('class' => 'btn')) }}

              </div>
              {{ Form::token() }}

            {{ Form::close() }}

