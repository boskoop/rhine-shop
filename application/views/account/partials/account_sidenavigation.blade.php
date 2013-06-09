{{--
    account_sidenavigation.blade.php

    Variables needed:
    -
--}}
        <ul class="nav nav-tabs nav-stacked">
@if(in_array(Request::route()->action['as'], array('account', 'profile', 'editprofile')))
          <li class="active">
@else
          <li>
@endif
          	<a href="{{ URL::to_route('profile') }}"><i class="icon-chevron-right"></i>{{ __('rhine/account.profile') }}</a>
          </li>
@if(in_array(Request::route()->action['as'], array('address', 'editaddress')))
          <li class="active">
@else
          <li>
@endif
            <a href="{{ URL::to_route('address') }}"><i class="icon-chevron-right"></i>{{ __('rhine/account.address') }}</a>
          </li>
@if(in_array(Request::route()->action['as'], array('orders')))
          <li class="active">
@else
          <li>
@endif
          	<a href="{{ URL::to_route('orders') }}"><i class="icon-chevron-right"></i>{{ __('rhine/account.orders') }}</a>
          </li>
@if(in_array(Request::route()->action['as'], array('orderhistory')))
          <li class="active">
@else
          <li>
@endif
          	<a href="{{ URL::to_route('orderhistory') }}"><i class="icon-chevron-right"></i>{{ __('rhine/account.completed_orders') }}</a>
          </li>
        </ul>