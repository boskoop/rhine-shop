@layout('layout.master')

@section('sidenavigation')
        <ul class="breadcrumb well">
          <li class="active">{{ __('rhine/shop.categories') }}</li>
        </ul>
        <ul class="nav nav-tabs nav-stacked">
@foreach($categories as $category)
          <li{{ ($activeCategory == $category->id) ? ' class="active"' : '' }}><a href="{{ URL::to_route('category', array($category->id)) }}">{{ $category->name }}</a></li>
@endforeach
        </ul>
@endsection

@section('content')
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#">{{ __('rhine/shop.productrange') }}</a>
          </li>
          <li><a href="#">{{ __('rhine/shop.newarrivals') }}</a></li>
          <li><a href="#">{{ __('rhine/shop.bestsellers') }}</a></li>
        </ul>
        <ul class="thumbnails">
@foreach($products->results as $product)
          <li class="span3">
            <div class="thumbnail">
              <a class="text-center" href="#">
                {{ HTML::image('img/barcode_150.jpg', '') }}
              </a>
              <div class="caption">
                <a href="#">
                  <h4>{{ $product->name }}</h4>
                </a>
              </div>
            </div>
          </li>
@endforeach
        </ul>
        {{ $products->links() }}
@endsection