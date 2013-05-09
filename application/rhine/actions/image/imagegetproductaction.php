<?php namespace Rhine\Actions\Image;

use Rhine\Repositories\ProductRepository;
use Rhine\Repositories\ProductImageRepository;
use Laravel\Response;

class ImageGetProductAction
{

	private $productImageRepository;

	function __construct(ProductImageRepository $productImageRepository)
	{
		$this->productImageRepository = $productImageRepository;
	}

	/**
	 * @return string
	 */
	public function execute($productId)
	{
		$image = $this->productImageRepository->findByProductId($productId);
		if (is_null($image)) {
			return Response::error('404');
		}
		return $image->file;
	}

}