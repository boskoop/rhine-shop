{{--
    account_profile.blade.php

    Variables needed:
    - orders -> the orders in an array
--}}
@if(count($orders) < 1)
            <p class="text-info">{{ __('rhine/account.no_orders') }}</p>
@else
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Paid</th>
                  <th>Item</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Price total</th>
                </tr>
              </thead>
              <tbody>
                </tr>
                <tr class="table-condensed" style="background-color: #f9f9f9">
                  <td colspan="8"></td>
                </tr>
@foreach($orders as $order)
                <tr>
                  <td rowspan="{{ $order->getNumberOfItems() + ($order->isShipped() ? 2 : 1) }}">{{ $order->getOrderId() }}</td>
                  <td rowspan="{{ $order->getNumberOfItems() }}">{{ date('d.m.Y', strtotime($order->getOrderDate())) }}</td>
@if($order->isPaid())
                  <td rowspan="{{ $order->getNumberOfItems() }}">
                    <span class="label label-success"><i class="icon-ok-circle icon-white" ></i></span>
                  </td>
@else
                  <td rowspan="{{ $order->getNumberOfItems() }}">
                    <span class="label label-important"><i class="icon-ban-circle icon-white" ></i></span>
                  </td>
@endif
@foreach($order->getItems() as $item)
                  <td>{{ $item->getProductName() }}</td>
                  <td>{{ $item->getCategoryName() }}</td>
                  <td>{{ number_format($item->getUnitPrice() / 100, 2) }}</td>
                  <td>{{ $item->getQuantity() }}</td>
                  <td>{{ number_format($item->getTotalPrice() / 100, 2) }}</td>
                </tr>
                <tr>
@endforeach
                  <td colspan="6" style="text-align: right"><strong>Total SFr.</strong></td>
                  <td><strong>{{ number_format($order->getTotalPrice() / 100, 2) }}</strong></td>
                </tr>
@if($order->isShipped())
                <tr>
                  <td>{{ date('d.m.Y', strtotime($order->getShippedDate())) }}</td>
                  <td colspan="6"><strong>Order shipped</strong></td>
                </tr>
@endif
                <tr class="table-condensed" style="background-color: #f9f9f9">
                  <td colspan="8"></td>
                </tr>
@endforeach
              </tbody>
            </table>
@endif
