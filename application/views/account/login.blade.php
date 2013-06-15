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
@include('account.partials.account_login')
          </div>
@endsection