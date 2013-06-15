{{--
    account_login.blade.php

    Variables needed:
    -
--}}
            <h2>{{ __('rhine/account.login') }}</h2>
            <div class="well">
              {{ Form::open(URL::to_route('login'), 'POST', array('class' => 'form-horizontal')) }}

                <div class="control-group">
                  <label class="control-label" for="username">{{ __('rhine/account.username') }} <span class="mandatory">*</span></label>
                  <div class="controls">
                    {{ Form::text('username', '', array('id' => 'username', 'placeholder' => __('rhine/account.username'), 'required')) }}
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label" for="password">{{ __('rhine/account.password') }} <span class="mandatory">*</span></label>
                  <div class="controls">
                    {{ Form::password('password', array('id' => 'password', 'placeholder' => __('rhine/account.password'), 'required')) }}
                  </div>
                </div>

@if(Session::get('status') != null)
                <div class="alert alert-error fade in">
                  <a href="#" class="close" data-dismiss="alert">&times;</a>
                  {{ __('rhine/status.'.Session::get('status')) }}

                </div>
@elseif(Session::get('success') != null)
                <div class="alert alert-success fade in">
                  <a href="#" class="close" data-dismiss="alert">&times;</a>
                  {{ __('rhine/status.'.Session::get('success')) }}

                </div>
@endif
                
                <div class="control-group">
                  <div class="controls">
                    {{ Form::button(__('rhine/account.do_login'), array('class' => 'btn btn-primary', 'type' => 'submit')) }}

                    {{ HTML::link_to_route('register', __('rhine/account.do_register'), array(), array('class' => 'btn')) }}

                  </div>
                </div>
                {{ Form::token() }}

              {{ Form::close() }}

            </div>