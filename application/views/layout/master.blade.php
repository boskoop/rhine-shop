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
@unless($firstElement)
            |
@endunless
<?php
$firstElement = false;

$isCurrentLanguage = (Config::get('application.language') == $lang)
?>
@if($isCurrentLanguage)
            <strong>
@endif
            <a href="{{ URL::to_language($lang) }}">{{ __('rhine/header.'.$lang) }}</a>
@if($isCurrentLanguage)
            </strong>
@endif
@endforeach
          </p>
        </div>
        <div class="span3 text-right">
          <h4>{{ __('rhine/header.cart') }}</h4>
          <p><a href="{{ URL::to_route('cart') }}">2 {{ __('rhine/header.item') }} - $40.00</a></p>
        </div>
      </div>
      <div class="row">
        <div class="span12">
@yield('topnavigation')
        </div>
      </div>
      <div class="container">
        <div class="row">
@yield('sidenavigation')
@yield('content')
        </div>
      </div>
    </div>
    <div id="push"><!-- Pushes footer down --></div>
  </div>
  <div id="footer">
    <div class="container">
      <p class="muted credit text-center">
        <b>Rhine Shop</b> &copy; {{ Config::get('rhine.build#copyright') }}, <b>Version</b>: {{ Config::get('rhine.build#version') }}, <b>Build:</b> {{ Config::get('rhine.build#timestamp') }}
      </p>
    </div>
  </div>
  <!-- JavaScript placed at the end of the document so the pages load faster -->
  {{ Asset::scripts() }}
</body>
</html>