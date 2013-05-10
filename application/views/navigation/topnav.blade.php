{{--
    topnav.blade.php

    Variables needed:
    -

--}}
          <div class="navbar navbar-inverse">
            <div class="navbar-inner">
              <div class="container">
                <div class="nav-collapse">
                  <ul class="nav">
@if(in_array(Request::route()->action['as'], array('shop', 'home', 'category', 'product')))
                    <li class="active">
@else
                    <li>
@endif
                      <a href="{{ URL::to_route('shop') }}"><i class="icon-home icon-white"></i> {{ __('rhine/nav.shop') }}</a>
                    </li>
                    <li class="divider-vertical"></li>
@if(in_array(Request::route()->action['as'], array('cart')))
                    <li class="active">
@else
                    <li>
@endif
                      <a href="{{ URL::to_route('cart') }}"><i class="icon-shopping-cart icon-white"></i> {{ __('rhine/nav.cart') }}</a></li>
                    <li class="divider-vertical"></li>
@if(in_array(Request::route()->action['as'], array('account')))
                    <li class="active">
@else
                    <li>
@endif
                      <a href="{{ URL::to_route('account') }}"><i class="icon-user icon-white"></i> {{ __('rhine/nav.myaccount') }}</a></li>
                    <li class="divider-vertical"></li>
@if(in_array(Request::route()->action['as'], array('information')))
                    <li class="active">
@else
                    <li>
@endif
                      <a href="{{ URL::to_route('information') }}"><i class="icon-info-sign icon-white"></i> {{ __('rhine/nav.information') }}</a></li>
                  </ul>
                  <a href="#" class="btn btn-inverse pull-right"><i class="icon-off icon-white"></i> {{ __('rhine/nav.logout') }}</a>
                  <span class="divider-vertical pull-right">&nbsp;</span>
                  <form class="navbar-search pull-right" action="search">
                    <input type="text" class="search-query span2" placeholder="{{ __('rhine/nav.search') }}" />
                  </form>
                </div>
              </div>
            </div>
          </div>