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
@include('account.partials.account_orders')
          </div>
@endsection