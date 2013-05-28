{{--
    account_sidenavigation.blade.php

    Variables needed:
    - user -> the user
--}}
            <h2>Profile</h2>
            {{ Form::open(URL::current(), 'POST', array('class' => 'form-horizontal')) }}

              <div class="control-group">
                <label class="control-label" for="username">Username</label>
                <div class="controls">
                  <span class="uneditable-input" id="username">{{ $user->username }}</span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="email">Email</label>
                <div class="controls">
                  <span class="uneditable-input" id="email">{{ $user->email }}</span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="password">Password</label>
                <div class="controls">
                  <span class="uneditable-input" id="password">************</span>
                </div>
              </div>
              <div class="form-actions">
                  {{ HTML::link_to_route('editprofile', 'Edit', array() ,array('class' => 'btn')) }}

              </div>
            {{ Form::close() }}
