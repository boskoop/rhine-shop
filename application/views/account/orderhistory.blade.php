@layout('layout.master')


@section('topnavigation')
@include('navigation.topnav')
@endsection


@section('sidenavigation')
          <div class="span3">
@include('account.partials.account_sidenavigation')
          </div>
@endsection


@section('content')
          <div class="span9">
            <h2>{{ __('rhine/account.completed_orders') }}</h2>
@include('account.partials.account_orders')
          </div>
@endsection