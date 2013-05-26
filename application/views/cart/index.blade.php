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
            <h2>Cart</h2>
@if($cart->isEmpty())
            <p class="text-info">Your cart is empty.</p>
@endif
@unless($cart->isEmpty())
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Category</th>
                  <th>Delivery time</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Price total</th>
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
                  <td>Delivery time</td>
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
                  <td><strong>Total</strong></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><strong>{{ $cart->getTotalQuantity() }}</td>
                  <td><strong>SFr. {{ number_format($cart->getTotalPrice() / 100, 2) }}</strong></td>
                  <td style="padding-left: 0px; padding-right: 8px" colspan=3>
                    <form class="form-inline" method="get" action="#">
                      <button class="btn btn-success btn-small" type="submit"><i class="icon-check icon-white"></i> Checkout</button>
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>
@endunless
          </div>
@endsection