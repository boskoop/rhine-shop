<?php namespace Tests\Builder;

class EloquentPersister implements BuilderExtension {

	public function postBuild($entity)
	{
		$entity->save();
	}

}