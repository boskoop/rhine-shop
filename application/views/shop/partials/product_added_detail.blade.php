{{--
    product_detail.blade.php

    Variables needed:
    $product -> Product to display
    $productCategory -> Category of the Product
--}}
        <div class="row">
          <div class="span2">
            {{ HTML::image(URL::to_route('product_image', array($product->id)), '', array('width' => 110, 'height' => 155)) }}
          </div>
          <div class="span5">
            <p><em>{{ $productCategory->name }}</em></p>
            <h2>{{ $product->name }}</h2>
            <p class="lead">Details</p>
          </div>
          <div class="span3">
            <h3>SFr. {{ number_format($product->price / 100, 2) }}</h3>
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="span10">
            <div class="well">
              <div class="pull-left"><a class="btn" href="{{ URL::to_route('product', array($product->id)) }}">{{ __('rhine/product.go_to_product') }}</a></div>
              <div class="pull-right"><a class="btn btn-primary" href="{{ URL::to_route('cart') }}"><i class="icon-shopping-cart icon-white" ></i>&nbsp;{{ __('rhine/product.go_to_cart') }}</a></div>
              <p class="text-success text-center">{{ __('rhine/product.added_to_cart') }}</p>
            </p>
            </div>
          </div>
        </div>