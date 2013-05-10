@layout('layout.master')


@section('topnavigation')
@include('navigation.topnav')
@endsection


@section('sidenavigation')
@include('shop.partials.category_sidenavigation')
@endsection


@section('content')
@include('shop.partials.product_detail')
@endsection