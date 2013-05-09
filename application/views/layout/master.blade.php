<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>rhine shop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Styles -->
  {{ Asset::styles() }}
</head>
<body>
  <div id="wrap">
    <div class="container">
      <div class="row">
        <div class="span6">
          <h1>rhine shop</h1>
        </div>
        <div class="span3">
          <h4>{{ __('rhine/header.language') }}</h4>
          <p>
            <?php $firstElement = true; ?>
            @foreach(Config::get('application.languages') as $lang)
            @unless($firstElement)|@endunless
            <?php
            $firstElement = false;

            $isCurrentLanguage = (Config::get('application.language') == $lang)
            ?>
            @if($isCurrentLanguage)<strong>@endif
            <a href="{{ URL::to_language($lang) }}">{{ __('rhine/header.'.$lang) }}</a>
            @if($isCurrentLanguage)</strong>@endif
            @endforeach
          </p>
        </div>
        <div class="span3 text-right">
          <h4>{{ __('rhine/header.cart') }}</h4>
          <p><a href="#">2 {{ __('rhine/header.item') }} - $40.00</a></p>
        </div>
      </div>
      <div class="row">
        <div class="span12">
          <div class="navbar navbar-inverse">
            <div class="navbar-inner">
              <div class="container">
                <div class="nav-collapse">
                  <ul class="nav">
                    <li class="active"><a href="{{ URL::to_route('shop') }}">{{ __('rhine/nav.shop') }}</a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="{{ URL::to_route('cart') }}">{{ __('rhine/nav.cart') }}</a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="{{ URL::to_route('account') }}">{{ __('rhine/nav.myaccount') }}</a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="{{ URL::to_route('information') }}">{{ __('rhine/nav.information') }}</a></li>
                  </ul>
                  <a href="#" class="btn btn-inverse pull-right">{{ __('rhine/nav.logout') }}</a>
                  <span class="divider-vertical pull-right">&nbsp;</span>
                  <form class="navbar-search pull-right" action="search">
                    <input type="text" class="search-query span3" placeholder="{{ __('rhine/nav.search') }}" />
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="span3">
            @yield('sidenavigation')
          </div>
          <div class="span9">
            @yield('content')
          </div>
        </div>
      </div>
    </div>
    <div id="push"><!-- Pushes footer down --></div>
  </div>
  <div id="footer">
    <div class="container">
      <center>
        <p class="muted credit"><b>Rhine Shop</b> &copy; {{ Config::get('rhine.build#copyright') }}, <b>Version</b>: {{ Config::get('rhine.build#version') }}, <b>Build:</b> {{ Config::get('rhine.build#timestamp') }},</p>
      </center>
    </div>
  </div>
  <!-- JavaScript placed at the end of the document so the pages load faster -->
  {{ Asset::scripts() }}
</body>
</html>