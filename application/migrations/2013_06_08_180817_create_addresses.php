<?php

class Create_Addresses {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('genders', function($table) {
			$table->increments('id');
			$table->string('gender', 2)->unique();
			$table->timestamps();
		});

		Schema::create('addresses', function($table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->unique();
			$table->integer('gender_id')->unsigned();
			$table->string('forename', 64);
			$table->string('surname', 64);
			$table->string('street1', 64);
			$table->string('street2', 64)->nullable();
			$table->string('zip', 16);
			$table->string('city', 64);
			$table->string('country', 64);
			$table->timestamps();

			// fk (no support by sqlite -> disable in test)
			if (!Request::is_env('test')){
				$table->foreign('user_id')->references('id')->on('users')->on_delete('cascade')->on_update('cascade');
				$table->foreign('gender_id')->references('id')->on('genders')->on_delete('restrict')->on_update('cascade');
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
		Schema::drop('addresses');
		Schema::drop('genders');
	}

}