{{--
    account_deleteprofile.blade.php

    Variables needed:
    - user -> the user
--}}
            <h2>{{ __('rhine/account.delete') }}</h2>
            <div class="alert alert-block">
              <h4>{{ __('rhine/account.delete_warning') }}</h4>
              {{ __('rhine/account.delete_message') }}
            </div>
            {{ Form::open(URL::to_route('confirmdeleteprofile'), 'POST', array('class' => 'form-horizontal')) }}

              <div class="control-group">
                <div class="controls">
                  {{ HTML::image(LaraCaptcha\Captcha::img(), 'captcha', array('class' => 'captchaimg img-polaroid')) }}

                </div>
              </div>
              <div class="control-group{{ $errors->has('captcha') ? ' error' : '' }}">
                <label class="control-label" for="captcha">{{ __('rhine/account.captcha') }} <span class="mandatory">*</span></label>
                <div class="controls">
                  {{ Form::text('captcha', '', array('id' => 'captcha', 'placeholder' => __('rhine/account.captcha_text'), 'required', 'class' => 'captchainput')) }}

@if($errors->has('captcha'))
                  <span class="help-inline">{{ $errors->first('captcha') }}</span>
@endif
                </div>
              </div>

              <hr>
              <div class="control-group{{ $errors->has('password') ? ' error' : '' }}">
                <label class="control-label" for="password">{{ __('rhine/account.password') }} <span class="mandatory">*</span></label>
                <div class="controls">
                  <input type="password" id="password" name="password" placeholder="{{ __('rhine/account.password') }}">
@if($errors->has('password'))
                  <span class="help-inline">{{ $errors->first('password') }}</span>
@endif
                </div>
              </div>
                
              <div class="control-group">
                <div class="controls">
                  {{ Form::button(__('rhine/account.do_delete'), array('class' => 'btn btn-danger', 'type' => 'submit')) }}

                  {{ HTML::link_to_route('account', __('rhine/account.cancel'), array(), array('class' => 'btn')) }}

                </div>
              </div>
              {{ Form::token() }}

            {{ Form::close() }}


