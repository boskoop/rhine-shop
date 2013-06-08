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
                  <select id="title" name="title" placeholder="{{ __('rhine/account.title') }}" value="{{ $address->title }}" required>
@foreach(GenderEnum::values() as $gender)
                    <option>{{ __('rhine/account.title_'.$gender) }}</option>
@endforeach
                  </select>
@if($errors->has('title'))
                  <span class="help-inline">{{ $errors->first('title') }}</span>
@endif
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-primary">{{ __('rhine/account.save') }}</button>
                {{ HTML::link_to_route('address', __('rhine/account.cancel'), array(), array('class' => 'btn')) }}

              </div>
              {{ Form::token() }}

            {{ Form::close() }}

