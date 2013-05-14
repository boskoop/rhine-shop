{{--
    product_filter.blade.php

    Variables needed:
    $query -> search query
    $products -> paginated result of Product
--}}
        <h2>Search for: '{{ $query }}'</h2>
        <p>{{ $products->total }} hits</p>