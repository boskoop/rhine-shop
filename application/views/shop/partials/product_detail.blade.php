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
            <p>
              <a class="btn btn-primary" href="#"><i class="icon-shopping-cart icon-white" ></i>&nbsp;{{ __('rhine/product.add_to_cart') }}</a>
            </p>
            <p>
@if ( $product->stocksize >= 5)
              <span class="label label-success"><i class="icon-ok-circle icon-white" ></i></span>&nbsp;<span class="text-success">{{ __('rhine/product.available') }}</span>
@elseif ( $product->stocksize <= 0)
              <span class="label label-important"><i class="icon-ban-circle icon-white" ></i></span>&nbsp;<span class="text-error">{{ __('rhine/product.notavailable') }}</span>
@else
              <span class="label label-warning"><i class="icon-ok-circle icon-white" ></i></span>&nbsp;<span class="text-warning">{{ __('rhine/product.marginalavailable') }}</span>
@endif
            </p>
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="span5">
            <h4>Description</h4>
            <p>BlahBlah</p>
          </div>
          <div class="span5">
            <h4>Product details</h4>
            <p>BlahBlah</p>
          </div>
        </div>