@layout('layout.master')


@section('topnavigation')
@include('navigation.topnav')
@endsection


@section('sidenavigation')
          <div class="span3">
          </div>
@endsection


@section('content')
          <div class="span6">
            <h2>{{ __('rhine/account.do_register') }}</h2>
            <div class="well">
              {{ Form::open(URL::to_route('login'), 'POST', array('class' => 'form-horizontal')) }}

                <div class="control-grou{{ $errors->has('username') ? ' error' : '' }}p">
                  <label class="control-label" for="username">{{ __('rhine/account.username') }} <span class="mandatory">*</span></label>
                  <div class="controls">
                    {{ Form::text('username', '', array('id' => 'username', 'placeholder' => __('rhine/account.username'), 'required')) }}

@if($errors->has('username'))
                    <span class="help-inline">{{ $errors->first('username') }}</span>
@endif
                  </div>
                </div>
                <div class="control-group{{ $errors->has('email') ? ' error' : '' }}">
                  <label class="control-label" for="email">{{ __('rhine/account.email') }} <span class="mandatory">*</span></label>
                  <div class="controls">
                    {{ Form::text('email', '', array('id' => 'email', 'placeholder' => __('rhine/account.email'), 'required')) }}

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
                
                <div class="control-group">
                  <div class="controls">
                    {{ Form::button(__('rhine/account.do_register'), array('class' => 'btn btn-primary', 'type' => 'submit')) }}

                    {{ HTML::link_to_route('login', __('rhine/account.cancel'), array(), array('class' => 'btn')) }}

                  </div>
                </div>
                {{ Form::token() }}

              {{ Form::close() }}

            </div>
          </div>
@endsection