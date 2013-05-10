{{--
    information_sidenavigation.blade.php

    Variables needed:
    -
--}}
        <ul class="nav nav-tabs nav-stacked">
          <li class="active"><a href="{{ URL::to_route('information') }}"><i class="icon-chevron-right"></i>{{ __('rhine/information.about_us') }}</a></li>
          <li><a href="#"><i class="icon-chevron-right"></i>{{ __('rhine/information.contact') }}</a></li>
          <li><a href="#"><i class="icon-chevron-right"></i>{{ __('rhine/information.terms_of_business') }}</a></li>
        </ul>