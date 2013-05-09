<?php

class Create_ProductImages {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productimages', function($table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned()->unique();
			$table->blob('file');
			$table->timestamps();

			// fk (no support by sqlite -> disable in test)
			if (!Request::is_env('test'))
			{
				$table->foreign('product_id')->references('id')->on('products')->on_delete('cascade')->on_update('cascade');
			}
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('productimages');
	}

}