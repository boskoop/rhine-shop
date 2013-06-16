{{--
    account_sidenavigation_admin.blade.php

    Variables needed:
    -
--}}
        <ul class="breadcrumb well">
          <li class="active">{{ __('rhine/admin.administration') }}</li>
        </ul>
        <ul class="nav nav-tabs nav-stacked">
@if(in_array(Request::route()->action['as'], array('manage_users')))
          <li class="active">
@else
          <li>
@endif
            <a href="{{ URL::to_route('manage_users') }}"><i class="icon-chevron-right"></i>{{ __('rhine/admin.manage_users') }}</a>
          </li>
@if(in_array(Request::route()->action['as'], array('manage_orders')))
          <li class="active">
@else
          <li>
@endif
          	<a href="{{ URL::to_route('manage_orders') }}"><i class="icon-chevron-right"></i>{{ __('rhine/admin.manage_orders') }}</a>
          </li>
@if(in_array(Request::route()->action['as'], array('manage_categories')))
          <li class="active">
@else
          <li>
@endif
            <a href="{{ URL::to_route('manage_categories') }}"><i class="icon-chevron-right"></i>{{ __('rhine/admin.manage_categories') }}</a>
          </li>
@if(in_array(Request::route()->action['as'], array('manage_products')))
          <li class="active">
@else
          <li>
@endif
            <a href="{{ URL::to_route('manage_products') }}"><i class="icon-chevron-right"></i>{{ __('rhine/admin.manage_products') }}</a>
          </li>
        </ul>