{{--
    account_profile.blade.php

    Variables needed:
    - orders -> the orders in an array
--}}
@if(count($orders) < 1)
            <p class="text-info">{{ __('rhine/account.no_orders') }}</p>
@else
@if(Session::get('success') != null)
            <div class="alert alert-success fade in">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              {{ __('rhine/status.'.Session::get('success')) }}

            </div>
@endif
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{ __('rhine/account.order_date') }}</th>
                  <th>{{ __('rhine/account.order_item') }}</th>
                  <th>{{ __('rhine/account.order_category') }}</th>
                  <th>{{ __('rhine/account.order_price') }}</th>
                  <th>{{ __('rhine/account.order_quantity') }}</th>
                  <th>{{ __('rhine/account.order_pricetotal') }}</th>
                </tr>
              </thead>
              <tbody>
                </tr>
                <tr class="table-condensed" style="background-color: #f9f9f9">
                  <td colspan="8"></td>
                </tr>
@foreach($orders as $order)
                <tr>
                  <td rowspan="{{ $order->getNumberOfItems() + ($order->isShipped() ? 3 : 2) }}">{{ $order->getOrderId() }}</td>
                  <td rowspan="{{ $order->getNumberOfItems() + 1 }}">{{ date('d.m.Y', strtotime($order->getOrderDate())) }}</td>
@foreach($order->getItems() as $item)
                  <td>{{ $item->getProductName() }}</td>
                  <td>{{ $item->getCategoryName() }}</td>
                  <td>{{ number_format($item->getUnitPrice() / 100, 2) }}</td>
                  <td>{{ $item->getQuantity() }}</td>
                  <td>{{ number_format($item->getTotalPrice() / 100, 2) }}</td>
                </tr>
                <tr>
@endforeach
                  <td colspan="4" style="text-align: right"><strong>{{ __('rhine/account.order_total') }}</strong></td>
                  <td><strong>{{ number_format($order->getTotalPrice() / 100, 2) }}</strong></td>
                </tr>
@if($order->isPaid())
                <tr>
                  <td>{{ date('d.m.Y', strtotime($order->getPaymentDate())) }}</td>
                  <td colspan="4"><strong>{{ __('rhine/account.order_payment_ok') }}</strong></td>
                  <td>
                    <a href="{{ URL::to_route('orderpdf', array($order->getOrderId())) }}">
                      <span class="label label-info"><i class="icon-print icon-white" ></i> PDF</span>
                    </a>
                  </td>
                </tr>
@else
                <tr>
                  <td><span class="label label-important"><i class="icon-ban-circle icon-white" ></i></span></td>
                  <td colspan="4"><strong>{{ __('rhine/account.order_payment_nok') }}</strong></td>
                  <td>
                    <a href="{{ URL::to_route('orderpdf', array($order->getOrderId())) }}">
                      <span class="label label-info"><i class="icon-print icon-white" ></i> PDF</span>
                    </a>
                  </td>
                </tr>
@endif
@if($order->isShipped())
                <tr>
                  <td>{{ date('d.m.Y', strtotime($order->getShippedDate())) }}</td>
                  <td colspan="6"><strong>{{ __('rhine/account.order_shipped') }}</strong></td>
                </tr>
@endif
                <tr class="table-condensed" style="background-color: #f9f9f9">
                  <td colspan="8"></td>
                </tr>
@endforeach
              </tbody>
            </table>
@endif
