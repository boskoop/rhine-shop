{{--
    category_sidenavigation.blade.php

    Variables needed:
    $categories -> array of Category
    $activeCategory -> int, id of active Category
--}}
        <ul class="breadcrumb well">
          <li class="active">{{ __('rhine/shop.categories') }}</li>
        </ul>
        <ul class="nav nav-tabs nav-stacked">
@foreach($categories as $category)
          <li{{ ($activeCategory == $category->id) ? ' class="active"' : '' }}><a href="{{ URL::to_route('category', array($category->id)) }}">{{ $category->name }}</a></li>
@endforeach
        </ul>