{{--
    cart_checkout.blade.php

    Variables needed:
    - cart -> the cart
--}}
            <div class="pull-right">
              <form class="form-inline" method="get" action="{{ URL::to_route('cart') }}">
                <button class="btn btn-danger" type="submit">Zurück</button>
              </form>
            </div>
            <h2>{{ __('rhine/cart.checkout') }}</h2>
            <div class="row">
              <div class="span3">
                <h4>Adresse</h4>
              </div>
              <div class="span9">
                <h4>Warenkorb</h4>
              </div>
            </div>
            <div class="row">
              <div class="span3">
                <address id="address">
                  {{ __('rhine/account.title_'.$address->gender->gender) }}<br>
                  {{ $address->forename }} {{ $address->surname }}<br>
                  {{ $address->street1 }}<br>
@unless($address->street2 == null)
                  {{ $address->street2 }}<br>
@endunless
                  {{ $address->zip }} <strong>{{ $address->city }}</strong><br>
                  {{ $address->country }}<br>
                </address>
                <p>Die Adresse kann in den {{ HTML::link_to_route('editaddress', 'Kontoeinstellungen') }} geändert werden.
                {{ Form::open(URL::to_route('processcheckout'), 'POST') }}

                  <div class="control-group{{ ($errors->has('terms') ? ' error' : '') }}">
                    <label class="checkbox">
                      <input id="terms" name="terms" type="checkbox"> Ich akzeptiere die {{ HTML::link_to_route('information_tob', 'AGB', array(), array('target' => '_blank')) }}
                    </label>
@if($errors->has('terms'))
                    <span class="help-inline">{{ $errors->first('terms') }}</span><br>
@endif
                    <br>
                  </div>
                  <button class="btn btn-success" type="submit"><i class="icon-envelope icon-white"></i> Bestellung abschicken</button>
                  {{ Form::token() }}

                {{ Form::close() }}

              </div>
              <div class="span9">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>{{ __('rhine/cart.product') }}</th>
                      <th>{{ __('rhine/cart.category') }}</th>
                      <th>{{ __('rhine/cart.delivery_time') }}</th>
                      <th>{{ __('rhine/cart.price') }}</th>
                      <th>{{ __('rhine/cart.quantity') }}</th>
                      <th>{{ __('rhine/cart.price_total') }}</th>
                    </tr>
                  </thead>
                  <tbody>
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
                    </tr>
@endforeach
                    <tr>
                      <td><strong>{{ __('rhine/cart.total') }}</strong></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><strong>{{ $cart->getTotalQuantity() }}</td>
                      <td><strong>SFr. {{ number_format($cart->getTotalPrice() / 100, 2) }}</strong></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="pull-right">
                <form class="form-inline" method="get" action="{{ URL::to_route('cart') }}">
                  <button class="btn btn-danger" type="submit">Zurück</button>
                </form>
              </div>
            </div>