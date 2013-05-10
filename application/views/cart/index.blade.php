@layout('layout.master')


@section('topnavigation')
@include('navigation.topnav')
@endsection


@section('sidenavigation')
          <div class="span3">
Sidenavigation
          </div>
@endsection


@section('content')
          <div class="span9">
Cart: Content
          </div>
@endsection