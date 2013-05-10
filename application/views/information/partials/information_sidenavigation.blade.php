{{--
    information_sidenavigation.blade.php

    Variables needed:
    -
--}}
        <ul class="nav nav-tabs nav-stacked">
@if(in_array(Request::route()->action['as'], array('information', 'information_about')))
          <li class="active">
@else
          <li>
@endif
          	<a href="{{ URL::to_route('information_about') }}"><i class="icon-chevron-right"></i>{{ __('rhine/information.about_us') }}</a>
          </li>
@if(in_array(Request::route()->action['as'], array('information_contact')))
          <li class="active">
@else
          <li>
@endif
          	<a href="{{ URL::to_route('information_contact') }}"><i class="icon-chevron-right"></i>{{ __('rhine/information.contact') }}</a>
          </li>
@if(in_array(Request::route()->action['as'], array('information_tob')))
          <li class="active">
@else
          <li>
@endif
          	<a href="{{ URL::to_route('information_tob') }}"><i class="icon-chevron-right"></i>{{ __('rhine/information.terms_of_business') }}</a>
          </li>
        </ul>