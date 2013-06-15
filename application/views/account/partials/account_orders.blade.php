{{--
    account_profile.blade.php

    Variables needed:
    - user -> the user
--}}
            <h2>{{ __('rhine/account.profile') }}</h2>
            {{ Form::open(URL::current(), 'POST', array('class' => 'form-horizontal')) }}

              <div class="control-group">
                <label class="control-label" for="username">{{ __('rhine/account.username') }}</label>
                <div class="controls">
                  <span class="uneditable-input" id="username">{{ $user->username }}</span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="email">{{ __('rhine/account.email') }}</label>
                <div class="controls">
                  <span class="uneditable-input" id="email">{{ $user->email }}</span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="password">{{ __('rhine/account.password') }}</label>
                <div class="controls">
                  <span class="uneditable-input" id="password">************</span>
                </div>
              </div>  
@if(Session::get('status') != null)
              <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                {{ __('rhine/status.'.Session::get('status')) }}

              </div>
@endif
              <div class="form-actions">
                  {{ HTML::link_to_route('editprofile', __('rhine/account.edit'), array() ,array('class' => 'btn btn-primary')) }}

                  {{ HTML::link_to_route('deleteprofile', __('rhine/account.delete'), array() ,array('class' => 'btn')) }}

              </div>
            {{ Form::close() }}

