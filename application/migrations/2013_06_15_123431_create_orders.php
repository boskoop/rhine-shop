<?php

class Create_Orders {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function($table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->boolean('paid')->default(false);
			$table->date('shipped_at')->nullable()->default(null);
			$table->timestamps();

			// fk (no support by sqlite -> disable in test)
			if (!Request::is_env('test')){
				$table->foreign('user_id')->references('id')->on('users')->on_delete('cascade')->on_update('cascade');
			}
		});

		Schema::create('orderitems', function($table) {
			$table->increments('id');
			$table->integer('order_id')->unsigned();
			$table->string('product_name', 64);
			$table->string('category_name', 32);
			$table->integer('price');
			$table->integer('quantity');
			$table->timestamps();

			// fk (no support by sqlite -> disable in test)
			if (!Request::is_env('test')){
				$table->foreign('order_id')->references('id')->on('orders')->on_delete('cascade')->on_update('cascade');
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
		Schema::drop('orderitems');
		Schema::drop('orders');
	}

}