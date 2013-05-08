<?php

use \Laravel\Request;

class Create_Products {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function($table) {
			$table->increments('id');
			$table->string('name', 64);
			$table->integer('category')->unsigned();
			$table->integer('price');
			$table->integer('stocksize')->default(0);
			$table->timestamps();

			// indexes
			$table->index('name');

			// fk
			if (!Request::is_env('test'))
			{
				$table->foreign('category')->references('id')->on('categories')->on_delete('restrict')->on_update('cascade');
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
		Schema::drop('products');
	}

}