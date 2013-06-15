{{--
    account_login.blade.php

    Variables needed:
    - username
    - email
    - title
    - forename
    - surname
    - street1
    - stree2
    - zip
    - city
    - country => all cached values from previous request
--}}
            <h2>{{ __('rhine/account.do_register') }}</h2>
            <div class="well">
              {{ Form::open(URL::to_route('register'), 'POST', array('class' => 'form-horizontal')) }}

                <div class="control-group{{ $errors->has('username') ? ' error' : '' }}">
                  <label class="control-label" for="username">{{ __('rhine/account.username') }} <span class="mandatory">*</span></label>
                  <div class="controls">
                    {{ Form::text('username', $username, array('id' => 'username', 'placeholder' => __('rhine/account.username'), 'required')) }}

@if($errors->has('username'))
                    <span class="help-inline">{{ $errors->first('username') }}</span>
@endif
                  </div>
                </div>
                <div class="control-group{{ $errors->has('email') ? ' error' : '' }}">
                  <label class="control-label" for="email">{{ __('rhine/account.email') }} <span class="mandatory">*</span></label>
                  <div class="controls">
                    {{ Form::email('email', $email, array('id' => 'email', 'placeholder' => __('rhine/account.email'), 'required')) }}

@if($errors->has('email'))
                    <span class="help-inline">{{ $errors->first('email') }}</span>
@endif
                  </div>
                </div>
                <hr>

                <div class="control-group{{ $errors->has('password') ? ' error' : '' }}">
                  <label class="control-label" for="password">{{ __('rhine/account.password') }} <span class="mandatory">*</span></label>
                  <div class="controls">
                    {{ Form::password('password', array('id' => 'password', 'placeholder' => __('rhine/account.password'), 'required')) }}

@if($errors->has('password'))
                    <span class="help-inline">{{ $errors->first('password') }}</span>
@endif
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label" for="password_confirmation">{{ __('rhine/account.confirm') }} <span class="mandatory">*</span></label>
                  <div class="controls">
                    {{ Form::password('password_confirmation', array('id' => 'password_confirmation', 'placeholder' => __('rhine/account.confirm'), 'required')) }}

                  </div>
                </div>
                <hr>

                <div class="control-group{{ $errors->has('title') ? ' error' : '' }}">
                  <label class="control-label" for="title">{{ __('rhine/account.title') }} <span class="mandatory">*</span></label>
                  <div class="controls">
                    <select id="title" name="title" placeholder="{{ __('rhine/account.title') }}" required>
                      <option value=""></option>
@foreach(GenderEnum::all() as $gender)
                      <option{{ ($gender == $title)  ? ' selected="selected"' : '' }} value="{{ $gender }}">{{ __('rhine/account.title_'.GenderEnum::getValue($gender)) }}</option>
@endforeach
                    </select>
@if($errors->has('title'))
                    <span class="help-inline">{{ $errors->first('title') }}</span>
@endif
                  </div>
                </div>
                <div class="control-group{{ $errors->has('forename') ? ' error' : '' }}">
                  <label class="control-label" for="forename">{{ __('rhine/account.forename') }} <span class="mandatory">*</span></label>
                  <div class="controls">
                    {{ Form::text('forename', $forename, array('id' => 'forename', 'placeholder' => __('rhine/account.forename'), 'required')) }}

@if($errors->has('forename'))
                    <span class="help-inline">{{ $errors->first('forename') }}</span>
@endif
                  </div>
                </div>
                <div class="control-group{{ $errors->has('surname') ? ' error' : '' }}">
                  <label class="control-label" for="surname">{{ __('rhine/account.surname') }} <span class="mandatory">*</span></label>
                  <div class="controls">
                    {{ Form::text('surname', $surname, array('id' => 'surname', 'placeholder' => __('rhine/account.surname'), 'required')) }}

@if($errors->has('surname'))
                  <span class="help-inline">{{ $errors->first('surname') }}</span>
@endif
                  </div>
                </div>
                <div class="control-group{{ $errors->has('street1') ? ' error' : '' }}">
                  <label class="control-label" for="street1">{{ __('rhine/account.street1') }} <span class="mandatory">*</span></label>
                  <div class="controls">
                    {{ Form::text('street1', $street1, array('id' => 'street1', 'placeholder' => __('rhine/account.street1'), 'required')) }}

@if($errors->has('street1'))
                    <span class="help-inline">{{ $errors->first('street1') }}</span>
@endif
                  </div>
                </div>
                <div class="control-group{{ $errors->has('street2') ? ' error' : '' }}">
                  <label class="control-label" for="street2">{{ __('rhine/account.street2') }}</label>
                  <div class="controls">
                    {{ Form::text('street2', $street2, array('id' => 'street2', 'placeholder' => __('rhine/account.street2'))) }}

@if($errors->has('street2'))
                    <span class="help-inline">{{ $errors->first('street2') }}</span>
@endif
                  </div>
                </div>
                <div class="control-group{{ $errors->has('zip') ? ' error' : '' }}">
                  <label class="control-label" for="zip">{{ __('rhine/account.zip') }} <span class="mandatory">*</span></label>
                  <div class="controls">
                    {{ Form::text('zip', $zip, array('id' => 'zip', 'placeholder' => __('rhine/account.zip'), 'required')) }}

@if($errors->has('zip'))
                    <span class="help-inline">{{ $errors->first('zip') }}</span>
@endif
                  </div>
                </div>
                <div class="control-group{{ $errors->has('city') ? ' error' : '' }}">
                  <label class="control-label" for="city">{{ __('rhine/account.city') }} <span class="mandatory">*  </span></label>
                  <div class="controls">
                    {{ Form::text('city', $city, array('id' => 'city', 'placeholder' => __('rhine/account.city'), 'required')) }}

@if($errors->has('city'))
                    <span class="help-inline">{{ $errors->first('city') }}</span>
@endif
                  </div>
                </div>
                <div class="control-group{{ $errors->has('country') ? ' error' : '' }}">
                  <label class="control-label" for="country">{{ __('rhine/account.country') }} <span class="mandatory">*</span></label>
                  <div class="controls">
                    <select id="country" name="country" placeholder="{{ __('rhine/account.country') }}" required>
                      <option value=""></option>
                      <option{{ (CountryEnum::CH == $country)  ? ' selected="selected"' : '' }} value="{{ CountryEnum::CH }}">{{ __('rhine/country.'.strtolower(CountryEnum::CH)) }}</option>
                      <option value="">---</option>
@foreach(CountryEnum::all() as $countryEnum)
                      <option{{ ($countryEnum != CountryEnum::CH && $countryEnum == $country)  ? ' selected="selected"' : '' }} value="{{ $countryEnum }}">{{ __('rhine/country.'.strtolower($countryEnum)) }}</option>
@endforeach
                    </select>
@if($errors->has('country'))
                    <span class="help-inline">{{ $errors->first('country') }}</span>
@endif
                  </div>
                </div>
                <hr>

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
                
                <div class="control-group">
                  <div class="controls">
                    {{ Form::button(__('rhine/account.do_register'), array('class' => 'btn btn-primary', 'type' => 'submit')) }}

                    {{ HTML::link_to_route('login', __('rhine/account.cancel'), array(), array('class' => 'btn')) }}

                  </div>
                </div>
                {{ Form::token() }}

              {{ Form::close() }}

            </div>