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
        <div class="row">
<?php
$row = 0;
?>
@foreach($products->results as $product)
@if ( $row > 1 )
        </div>
        <hr />
        <div class="row">
<?php
$row = 0;
?>
@endif
          <div class="span5">
            <div style="padding: 0px 20px 20px 0px; min-height: 140px; position: relative;">
              <a class="pull-left" href="{{ URL::to_route('product', array($product->id)) }}" style="padding-right: 20px;">
                {{ HTML::image(URL::to_route('product_image', array($product->id)), '', array('width' => 110, 'height' => 155)) }}
              </a>
              <h4><a href="{{ URL::to_route('product', array($product->id)) }}">{{ $product->name }}</a></h4>
              <p>Description</p>
@if ( $product->stocksize >= 5)
              <span class="label label-success"><i class="icon-ok-circle icon-white" ></i></span>&nbsp;<small class="text-success">{{ __('rhine/product.available') }}</small>
@elseif ( $product->stocksize <= 0)
              <span class="label label-important"><i class="icon-ban-circle icon-white" ></i></span>&nbsp;<small class="text-error">{{ __('rhine/product.notavailable') }}</small>
@else
              <span class="label label-warning"><i class="icon-ok-circle icon-white" ></i></span>&nbsp;<small class="text-warning">{{ __('rhine/product.marginalavailable') }}</small>
@endif
              <h5>SFr. {{ number_format($product->price / 100, 2) }}</h5>
              <p style="position: absolute; bottom: 0; right: 40px;"><a class="btn btn-primary btn-small" href="#"><i class="icon-shopping-cart icon-white" ></i>&nbsp;{{ __('rhine/product.add_to_cart') }}</a></p>
            </div>
          </div>
<?php
$row++;
?>
@endforeach
        </div>
        {{ $products->links() }}
@endsection