@layout('layout.master')


@section('topnavigation')
@include('navigation.topnav')
@endsection


@section('sidenavigation')
          <div class="span2">
@include('shop.partials.category_sidenavigation')
          </div>
@endsection


@section('content')
          <div class="span10">
        <h2>{{ __('rhine/search.search_for') }}: '{{ $query }}'</h2>
        <p class="text-error"><strong>{{ __('rhine/search.error') }}:</strong> {{ __('rhine/search.query_too_short') }}</p>
          </div>
@endsection