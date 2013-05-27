{{--
    account_sidenavigation.blade.php

    Variables needed:
    -
--}}
        <ul class="nav nav-tabs nav-stacked">
@if(in_array(Request::route()->action['as'], array('account', 'user')))
          <li class="active">
@else
          <li>
@endif
          	<a href="{{ URL::to_route('user') }}"><i class="icon-chevron-right"></i>User</a>
          </li>
@if(in_array(Request::route()->action['as'], array('address')))
          <li class="active">
@else
          <li>
@endif
            <a href="{{ URL::to_route('address') }}"><i class="icon-chevron-right"></i>Address</a>
          </li>
@if(in_array(Request::route()->action['as'], array('orders')))
          <li class="active">
@else
          <li>
@endif
          	<a href="{{ URL::to_route('orders') }}"><i class="icon-chevron-right"></i>Orders</a>
          </li>
@if(in_array(Request::route()->action['as'], array('orderhistory')))
          <li class="active">
@else
          <li>
@endif
          	<a href="{{ URL::to_route('orderhistory') }}"><i class="icon-chevron-right"></i>Completed orders</a>
          </li>
        </ul>