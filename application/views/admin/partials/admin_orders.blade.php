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
                    {{ Form::open(URL::to_route('payorder', array($order->getOrderId())), 'POST', array('class' => 'form-inline span4', 'style' => 'margin-bottom: 0')) }}

                      {{ Form::hidden('order_id', $order->getOrderId()) }}

@if($order->isPaid())
                      <button href="#confirm-reset-pay-{{ $order->getOrderId() }}" type="button" data-toggle="modal" class="btn btn-small btn-danger">{{ __('rhine/admin.order_reset_pay') }}</button>
                      <div id="confirm-reset-pay-{{ $order->getOrderId() }}" class="modal hide fade" style="text-align: left">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h3>{{ __('rhine/admin.order_confirm_question') }}</h3>
                        </div>
                        <div class="modal-body">
                          <p>{{ __('rhine/admin.order_confirm_info') }}</p>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-danger">{{ __('rhine/admin.order_confirm_reset_pay') }}</button>
                          <a href="#confirm-reset-pay-{{ $order->getOrderId() }}" role="button" class="btn" data-toggle="modal">{{ __('rhine/admin.cancel') }}</a>
                        </div>
                      </div>
@else
                      <button type="submit" class="btn btn-small btn-success">{{ __('rhine/admin.order_pay') }}</button>
@endif
                      {{ Form::token() }}

                    {{ Form::close() }}

                    {{ Form::open(URL::to_route('shiporder', array($order->getOrderId())), 'POST', array('class' => 'form-inline span4', 'style' => 'margin-bottom: 0; text-align: center')) }}

                      {{ Form::hidden('order_id', $order->getOrderId()) }}

@if($order->isShipped())
                      <button href="#confirm-reset-ship-{{ $order->getOrderId() }}" type="button" data-toggle="modal" class="btn btn-small btn-danger">{{ __('rhine/admin.order_reset_ship') }}</button>
                      <div id="confirm-reset-ship-{{ $order->getOrderId() }}" class="modal hide fade" style="text-align: left">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h3>{{ __('rhine/admin.order_confirm_question') }}</h3>
                        </div>
                        <div class="modal-body">
                          <p>{{ __('rhine/admin.order_confirm_info') }}</p>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-danger">{{ __('rhine/admin.order_confirm_reset_ship') }}</button>
                          <a href="#confirm-reset-ship-{{ $order->getOrderId() }}" role="button" class="btn" data-toggle="modal">{{ __('rhine/admin.cancel') }}</a>
                        </div>
                      </div>
@else
                      <button type="submit" class="btn btn-small btn-success">{{ __('rhine/admin.order_ship') }}</button>
@endif
                      {{ Form::token() }}

                    {{ Form::close() }}

                    {{ Form::open(URL::to_route('deleteorder', array($order->getOrderId())), 'POST', array('class' => 'form-inline span4', 'style' => 'margin-bottom: 0; text-align: right')) }}

                      {{ Form::hidden('order_id', $order->getOrderId()) }}

                      <button href="#confirm-delete-{{ $order->getOrderId() }}" type="button" data-toggle="modal" class="btn btn-small btn-danger">{{ __('rhine/admin.order_delete') }}</button>
                      <div id="confirm-delete-{{ $order->getOrderId() }}" class="modal hide fade" style="text-align: left">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h3>{{ __('rhine/admin.order_delete_question') }}</h3>
                        </div>
                        <div class="modal-body">
                          <p>{{ __('rhine/admin.order_delete_info') }}</p>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-danger">{{ __('rhine/admin.order_confirm_delete') }}</button>
                          <a href="#confirm-delete-{{ $order->getOrderId() }}" role="button" class="btn" data-toggle="modal">{{ __('rhine/admin.cancel') }}</a>
                        </div>
                      </div>
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
