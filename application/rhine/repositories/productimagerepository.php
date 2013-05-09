<?php namespace Rhine\Repositories;

use ProductImage;

interface ProductImageRepository
{
	/**
	 * Returns the ProductImage of a Product.
	 * 
	 * @return ProductImage
	 */
	function findByProductId($productId);

}