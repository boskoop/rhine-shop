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
                  <th style="width: 30px"></th>
                  <th style="width: 30px"></th>
                  <th style="width: 30px"></th>
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
                  <td>
                    <form class="form-inline" method="post" action="{{ URL::to_route('cartadd', $position->getProductId()) }}">
                      <button class="btn btn-primary btn-mini" type="submit"><i class="icon-plus icon-white"></i></button>
                    </form>
                  </td>
                  <td>
                    <form class="form-inline" method="post" action="{{ URL::to_route('cartsub', $position->getProductId()) }}">
                      <button class="btn btn-primary btn-mini" type="submit"><i class="icon-minus icon-white"></i></button>
                    </form>
                  </td>
                  <td>
                    <form class="form-inline" method="post" action="{{ URL::to_route('cartdel', $position->getProductId()) }}">
                      <button class="btn btn-danger btn-mini" type="submit"><i class="icon-remove icon-white"></i></button>
                    </form>
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
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
@endunless
          </div>
@endsection