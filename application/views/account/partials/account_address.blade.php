{{--
    account_address.blade.php

    Variables needed:
    - address -> the address
    - user -> the user
--}}
            <h2>{{ __('rhine/account.address') }}</h2>
            <p>Your orders will be shipped to the following address:</p>
            {{ Form::open(URL::current(), 'POST', array('class' => 'form-horizontal')) }}

            <div class="control-group">
              <label class="control-label" for="address">&nbsp;</label>
              <div class="controls">
                <address id="address">
                  Mr.<br>
                  Bart Simpson<br>
                  c/o Homer Simpson<br>
                  742 Evergreen Terrace<br>
                  1337 <strong>Springfield</strong><br>
                  USA<br>
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
                {{ HTML::link_to_route('address', __('rhine/account.edit'), array() ,array('class' => 'btn')) }}

            </div>
            {{ Form::close() }}

