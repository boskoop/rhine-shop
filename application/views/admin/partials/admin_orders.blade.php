{{--
    admin_orders.blade.php

    Variables needed:
    - orders -> the orders paginated
--}}
@if(count($orders->results) < 1)
            <p class="text-info">{{ __('rhine/account.no_orders') }}</p>
@else
            {{ $orders->links() }}
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
                <tr style="background-color: #f9f9f9">
                  <td colspan="8"></td>
                </tr>
@foreach($orders->results as $order)
                <tr>
                  <td rowspan="{{ $order->getNumberOfItems() + ($order->isShipped() ? 4 : 3) }}">{{ $order->getOrderId() }}</td>
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
                <tr>
                  <td colspan="7">
                    <div class="row-fluid">
@if($order->isPaid())
                    {{ Form::open(URL::to_route('manage_orders'), 'POST', array('class' => 'form-inline span4', 'style' => 'margin-bottom: 0')) }}

                      <button type="submit" class="btn btn-small btn-danger">{{ __('rhine/admin.order_reset_pay') }}</button>
                      {{ Form::token() }}

                    {{ Form::close() }}

@else
                    {{ Form::open(URL::to_route('manage_orders'), 'POST', array('class' => 'form-inline span4', 'style' => 'margin-bottom: 0')) }}

                      <button type="submit" class="btn btn-small btn-success">{{ __('rhine/admin.order_pay') }}</button>
                      {{ Form::token() }}

                    {{ Form::close() }}

@endif
@if($order->isShipped())
                    {{ Form::open(URL::to_route('manage_orders'), 'POST', array('class' => 'form-inline span4', 'style' => 'margin-bottom: 0; text-align: center')) }}

                      <button type="submit" class="btn btn-small btn-danger">{{ __('rhine/admin.order_reset_ship') }}</button>
                      {{ Form::token() }}

                    {{ Form::close() }}

@else
                    {{ Form::open(URL::to_route('manage_orders'), 'POST', array('class' => 'form-inline span4', 'style' => 'margin-bottom: 0; text-align: center')) }}

                      <button type="submit" class="btn btn-small btn-success">{{ __('rhine/admin.order_ship') }}</button>
                      {{ Form::token() }}

                    {{ Form::close() }}

@endif
                    {{ Form::open(URL::to_route('manage_orders'), 'POST', array('class' => 'form-inline span4', 'style' => 'margin-bottom: 0; text-align: right')) }}

                      <button type="submit" class="btn btn-small btn-danger">{{ __('rhine/admin.order_delete') }}</button>
                      {{ Form::token() }}

                    {{ Form::close() }}

                    </div>
                  </td>
                </tr>
                <tr style="background-color: #f9f9f9">
                  <td colspan="8"></td>
                </tr>
@endforeach
              </tbody>
            </table>
            {{ $orders->links() }}
@endif
