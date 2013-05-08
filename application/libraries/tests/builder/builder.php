<?php namespace Tests\Builder;

abstract class Builder {

	public function __construct() {}

	public function build()
	{
		return $this->buildInternal(null);
	}

	public function buildWith(BuilderExtension $extension)
	{
		$entity = $this->buildInternal($extension);
		$extension->postBuild($entity);
		return $entity;
	}


	protected abstract function buildInternal(BuilderExtension $extension);

}