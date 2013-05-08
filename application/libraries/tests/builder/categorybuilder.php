<?php namespace Tests\Builder;

class CategoryBuilder extends Builder {

	private $name;
	private $order;

	public function __construct()
	{
		parent::__construct();
		$this->name = 'comic';
		$this->order = 1;
	}

	public static function aCategory()
	{
		return new self();
	}

	protected function buildInternal(BuilderExtension $extension)
	{
		$category = new Category;
		$category->name = $this->name;
		$category->order = $this->order;
		return $category;
	}

	public function withName($name)
	{
		$this->name = $name;
		return $this;
	}

	public function withOrder($order)
	{
		$this->order = $order;
		return $this;
	}

}