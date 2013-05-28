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
                  <input type="text" id="username" placeholder="Username" value="{{ $user->username }}" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="email">Email <span class="mandatory">*</span></label>
                <div class="controls">
                  <input type="email" id="email" placeholder="Email" value="{{ $user->email }}" required>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="password">Password</label>
                <div class="controls">
                  <input type="password" id="password" placeholder="Password">
                  <span class="help-block">Leave password empty if you don't want to change it</span>
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save changes</button>
                {{ HTML::link_to_route('profile', 'Cancel', array() ,array('class' => 'btn')) }}

              </div>
              {{ Form::token() }}

            {{ Form::close() }}
