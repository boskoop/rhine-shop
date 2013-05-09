<?php namespace Rhine\Repositories\Eloquent;

use ProductImage;
use Rhine\Repositories\ProductImageRepository;

class EloquentProductImageRepository implements ProductImageRepository
{
	
	function findByProductId($productId)
	{
		return ProductImage::where('product_id', '=', $productId)->first();
	}

}