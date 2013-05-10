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
          <div class="span6 offset1">
@include('information.partials.terms_of_business_'.Config::get('application.language'))
          </div>
@endsection