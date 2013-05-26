@layout('layout.master')
{{-- index.blade.php
{{-- Variables needed:
{{-- - cart -> cart contents

@section('topnavigation')
@include('navigation.topnav')
@endsection


@section('sidenavigation')
@endsection


@section('content')
          <div class="span12">
@unless($cart->isEmpty())
            <div class="pull-right">
              <form class="form-inline" method="get" action="#">
                <button class="btn btn-success" type="submit"><i class="icon-check icon-white"></i> {{ __('rhine/cart.checkout') }}</button>
              </form>
            </div>
@endunless
            <h2>{{ __('rhine/cart.cart') }}</h2>
@if($cart->isEmpty())
            <p class="text-info">{{ __('rhine/cart.empty') }}</p>
@endif
@unless($cart->isEmpty())
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>{{ __('rhine/cart.product') }}</th>
                  <th>{{ __('rhine/cart.category') }}</th>
                  <th>{{ __('rhine/cart.delivery_time') }}</th>
                  <th>{{ __('rhine/cart.price') }}</th>
                  <th>{{ __('rhine/cart.quantity') }}</th>
                  <th>{{ __('rhine/cart.price_total') }}</th>
                  <th style="width: 20px; padding-left: 0px; padding-right: 0px"></th>
                  <th style="width: 20px; padding-left: 0px; padding-right: 0px"></th>
                  <th style="width: 20px; padding-left: 0px; padding-right: 0px"></th>
                </tr>
              </thead>
              <tbody>
@endunless
@foreach($cart->getPositions() as $position)
                <tr>
                  <td>{{ HTML::link_to_route('product', $position->getProduct()->name, array($position->getProductId())) }}</td>
                  <td>{{ HTML::link_to_route('category', $position->getProduct()->category->name, array($position->getProduct()->category->id)) }}</td>
                  <td>
@if ( $position->getProduct()->stocksize >= 5)
                    <span class="label label-success"><i class="icon-ok-circle icon-white" ></i></span>&nbsp;<span class="text-success">{{ __('rhine/product.available') }}</span>
@elseif ( $position->getProduct()->stocksize <= 0)
                    <span class="label label-important"><i class="icon-ban-circle icon-white" ></i></span>&nbsp;<span class="text-error">{{ __('rhine/product.notavailable') }}</span>
@else
                    <span class="label label-warning"><i class="icon-ok-circle icon-white" ></i></span>&nbsp;<span class="text-warning">{{ __('rhine/product.marginalavailable') }}</span>
@endif
                  </td>
                  <td>SFr. {{ number_format($position->getUnitPrice() / 100, 2) }}</td>
                  <td>{{ $position->getQuantity() }}</td>
                  <td>SFr. {{ number_format($position->getTotalPrice() / 100, 2) }}</td>
                  <td style="padding-left: 0px; padding-right: 0px">
                    {{ Form::open(URL::to_route('cartadd', array($position->getProductId())), 'POST', array('class' => 'form-inline')) }}

                      <button class="btn btn-primary btn-mini" type="submit"><i class="icon-plus icon-white"></i></button>
                      {{ Form::token() }}

                    {{ Form::close() }}

                  </td>
                  <td style="padding-left: 4px; padding-right: 0px">
                    {{ Form::open(URL::to_route('cartsub', array($position->getProductId())), 'POST', array('class' => 'form-inline')) }}

                      <button class="btn btn-primary btn-mini" type="submit"><i class="icon-minus icon-white"></i></button>
                      {{ Form::token() }}
                      
                    {{ Form::close() }}

                  </td>
                  <td style="padding-left: 4px; padding-right: 8px">
                    {{ Form::open(URL::to_route('cartdel', array($position->getProductId())), 'POST', array('class' => 'form-inline')) }}

                      <button class="btn btn-danger btn-mini" type="submit"><i class="icon-remove icon-white"></i></button>
                      {{ Form::token() }}
                      
                    {{ Form::close() }}

                  </td>
                </tr>
@endforeach
@unless($cart->isEmpty())
                <tr>
                  <td><strong>{{ __('rhine/cart.total') }}</strong></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><strong>{{ $cart->getTotalQuantity() }}</td>
                  <td><strong>SFr. {{ number_format($cart->getTotalPrice() / 100, 2) }}</strong></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
@endunless
          </div>
@unless($cart->isEmpty())
          <div class="span12">
            <form class="form-inline pull-right" method="get" action="#">
              <button class="btn btn-success" type="submit"><i class="icon-check icon-white"></i> {{ __('rhine/cart.checkout') }}</button>
            </form>
          </div>
@endunless
@endsection