@layout('layout.master')


@section('topnavigation')
@include('navigation.topnav')
@endsection


@section('sidenavigation')
@include('information.partials.information_sidenavigation')
@endsection


@section('content')
Information: Content
@endsection