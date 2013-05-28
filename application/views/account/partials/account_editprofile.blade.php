{{--
    account_sidenavigation.blade.php

    Variables needed:
    - user -> the user
--}}
            <h2>Profile</h2>
            {{ Form::open(URL::current(), 'POST', array('class' => 'form-horizontal')) }}

              <div class="control-group">
                <label class="control-label" for="username">Username <span class="mandatory">*</span></label>
                <div class="controls">
                  <input type="text" id="username" name="username" placeholder="Username" value="{{ $user->username }}" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="email">Email <span class="mandatory">*</span></label>
                <div class="controls">
                  <input type="email" id="email" name="email" placeholder="Email" value="{{ $user->email }}" required>
                </div>
              </div>
              <hr>
              <div class="control-group">
                <label class="control-label" for="old_password">Old Password</label>
                <div class="controls">
                  <input type="password" id="old_password" name="old_password" placeholder="Old password">
                  <span class="help-block">Leave empty if you don't want to change the password</span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="password">New Password</label>
                <div class="controls">
                  <input type="password" id="password" name="password" placeholder="New password">
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
