{{--
    account_address.blade.php

    Variables needed:
    - address -> the address
--}}
            <h2>{{ __('rhine/account.address') }}</h2>
            <p>{{ __('rhine/account.address_info') }}</p>
            {{ Form::open(URL::current(), 'POST', array('class' => 'form-horizontal')) }}

            <div class="control-group">
              <label class="control-label" for="address">&nbsp;</label>
              <div class="controls">
                <address id="address">
                  {{ __('rhine/account.title_'.$address->gender->gender) }}<br>
                  {{ $address->forename }} {{ $address->surname }}<br>
                  {{ $address->street1 }}<br>
@unless($address->street2 == null)
                  {{ $address->street2 }}<br>
@endunless
                  {{ $address->zip }} <strong>{{ $address->city }}</strong><br>
                  {{ $address->country }}<br>
                </address>
              </div>
            </div>
@if(Session::get('status') != null)
            <div class="alert alert-success fade in">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              {{ __('rhine/status.'.Session::get('status')) }}

            </div>
@endif
            <div class="form-actions">
                {{ HTML::link_to_route('editaddress', __('rhine/account.edit'), array() ,array('class' => 'btn')) }}

            </div>
            {{ Form::close() }}

