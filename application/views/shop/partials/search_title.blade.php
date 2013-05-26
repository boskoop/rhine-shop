{{--
    product_filter.blade.php

    Variables needed:
    $query -> search query
    $products -> paginated result of Product
--}}
        <h2>{{ __('rhine/search.search_for') }}: '{{ $query }}'</h2>
        <p class="text-info">{{ $products->total }} {{ __('rhine/search.hits') }}</p>