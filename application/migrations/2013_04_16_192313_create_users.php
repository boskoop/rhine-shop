<?php

class Create_Users {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function($table) {
			$table->increments('id');
			$table->string('role', 6)->unique();
			$table->timestamps();
		});

		Role::create(array(
			'id' => RoleEnum::USER,
			'role' => RoleEnum::USER_VALUE
		));
		Role::create(array(
			'id' => RoleEnum::ADMIN,
			'role' => RoleEnum::ADMIN_VALUE
		));

		Schema::create('users', function($table) {
			$table->increments('id');
			$table->integer('role_id')->unsigned();
			$table->string('username', 32)->unique();
			$table->string('email', 128);
			$table->string('password', 64);
			$table->timestamps();

			// fk (no support by sqlite -> disable in test)
			if (!Request::is_env('test')){
				$table->foreign('role_id')->references('id')->on('roles')->on_delete('restrict')->on_update('cascade');
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
		Schema::drop('users');
		Schema::drop('roles');
	}

}