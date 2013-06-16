@layout('layout.master')


@section('topnavigation')
@include('navigation.topnav')
@endsection


@section('sidenavigation')
          <div class="span3">
@include('account.partials.account_sidenavigation')
@if($user->isAdmin())
@include('admin.partials.admin_sidenavigation')
@endif
          </div>
@endsection


@section('content')
          <div class="span9">
            <h2>{{ __('rhine/account.orders') }}</h2>
@include('account.partials.account_orders')
          </div>
@endsection