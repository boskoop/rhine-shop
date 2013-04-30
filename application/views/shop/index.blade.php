@layout('layout.master')

@section('sidenavigation')
        <ul class="breadcrumb well">
          <li class="active">{{ __('rhine/shop.categories') }}</li>
        </ul>
        <ul class="nav nav-tabs nav-stacked">
@foreach($categories as $category)
          <li><a href="category/{{ $category->id }}">{{ $category->name }}</a></li>
@endforeach
        </ul>
@endsection