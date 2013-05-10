@layout('layout.master')


@section('topnavigation')
@include('navigation.topnav')
@endsection


@section('sidenavigation')
          <div class="span3">
@include('information.partials.information_sidenavigation')
          </div>
@endsection


@section('content')
          <div class="span9">
Information: Content
          </div>
@endsection