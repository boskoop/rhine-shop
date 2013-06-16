@layout('layout.master')


@section('topnavigation')
@include('navigation.topnav')
@endsection


@section('sidenavigation')
@endsection


@section('content')
          <div class="span12">
@include('cart.partials.cart_index')
          </div>
@endsection