{{--
    account_editaddress.blade.php

    Variables needed:
    - address -> the values to be prefilled
--}}
            <h2>{{ __('rhine/account.edit_address') }}</h2>
            {{ Form::open(URL::to_route('editaddress'), 'POST', array('class' => 'form-horizontal')) }}

              <div class="control-group{{ $errors->has('title') ? ' error' : '' }}">
                <label class="control-label" for="title">{{ __('rhine/account.title') }} <span class="mandatory">*</span></label>
                <div class="controls">
                  <select id="title" name="title" placeholder="{{ __('rhine/account.title') }}" required>
@foreach(GenderEnum::all() as $gender)
                    <option{{ ($gender == $address->gender_id)  ? ' selected="selected"' : '' }} value="{{ $gender }}">{{ __('rhine/account.title_'.GenderEnum::getValue($gender)) }}</option>
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
                  <input type="forename" id="forename" name="forename" placeholder="{{ __('rhine/account.forename') }}" value="{{ $address->forename }}" required>
@if($errors->has('forename'))
                  <span class="help-inline">{{ $errors->first('forename') }}</span>
@endif
                </div>
              </div>
              <div class="control-group{{ $errors->has('surname') ? ' error' : '' }}">
                <label class="control-label" for="surname">{{ __('rhine/account.surname') }} <span class="mandatory">*</span></label>
                <div class="controls">
                  <input type="surname" id="surname" name="surname" placeholder="{{ __('rhine/account.surname') }}" value="{{ $address->surname }}" required>
@if($errors->has('surname'))
                  <span class="help-inline">{{ $errors->first('surname') }}</span>
@endif
                </div>
              </div>
              <div class="control-group{{ $errors->has('street1') ? ' error' : '' }}">
                <label class="control-label" for="street1">{{ __('rhine/account.street1') }} <span class="mandatory">*</span></label>
                <div class="controls">
                  <input type="street1" id="street1" name="street1" placeholder="{{ __('rhine/account.street1') }}" value="{{ $address->street1 }}" required>
@if($errors->has('street1'))
                  <span class="help-inline">{{ $errors->first('street1') }}</span>
@endif
                </div>
              </div>
              <div class="control-group{{ $errors->has('street2') ? ' error' : '' }}">
                <label class="control-label" for="street2">{{ __('rhine/account.street2') }}</label>
                <div class="controls">
                  <input type="street2" id="street2" name="street2" placeholder="{{ __('rhine/account.street2') }}" value="{{ $address->street2 }}">
@if($errors->has('street2'))
                  <span class="help-inline">{{ $errors->first('street2') }}</span>
@endif
                </div>
              </div>
              <div class="control-group{{ $errors->has('zip') ? ' error' : '' }}">
                <label class="control-label" for="zip">{{ __('rhine/account.zip') }} <span class="mandatory">*</span></label>
                <div class="controls">
                  <input type="zip" id="zip" name="zip" placeholder="{{ __('rhine/account.zip') }}" value="{{ $address->zip }}" required>
@if($errors->has('zip'))
                  <span class="help-inline">{{ $errors->first('zip') }}</span>
@endif
                </div>
              </div>
              <div class="control-group{{ $errors->has('city') ? ' error' : '' }}">
                <label class="control-label" for="city">{{ __('rhine/account.city') }} <span class="mandatory">*</span></label>
                <div class="controls">
                  <input type="city" id="city" name="city" placeholder="{{ __('rhine/account.city') }}" value="{{ $address->city }}" required>
@if($errors->has('city'))
                  <span class="help-inline">{{ $errors->first('city') }}</span>
@endif
                </div>
              </div>
              <div class="control-group{{ $errors->has('country') ? ' error' : '' }}">
                <label class="control-label" for="country">{{ __('rhine/account.country') }} <span class="mandatory">*</span></label>
                <div class="controls">
                 <select id="country" name="country" placeholder="{{ __('rhine/account.country') }}" required>
                    <option{{ (CountryEnum::CH == $address->country)  ? ' selected="selected"' : '' }} value="{{ CountryEnum::CH }}">{{ __('rhine/country.'.strtolower(CountryEnum::CH)) }}</option>
                    <option value="">---</option>
@foreach(CountryEnum::all() as $country)
                    <option{{ ($country != CountryEnum::CH && $country == $address->country)  ? ' selected="selected"' : '' }} value="{{ $country }}">{{ __('rhine/country.'.strtolower($country)) }}</option>
@endforeach
                  </select>
@if($errors->has('country'))
                  <span class="help-inline">{{ $errors->first('country') }}</span>
@endif
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-primary">{{ __('rhine/account.save') }}</button>
                {{ HTML::link_to_route('address', __('rhine/account.cancel'), array(), array('class' => 'btn')) }}

              </div>
              {{ Form::token() }}

            {{ Form::close() }}

