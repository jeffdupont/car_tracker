<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->command->info('User table seeded!');
	}

}

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		User::create([
			'first_name' => 'Jeff',
			'last_name' => 'Dupont',
			'display_name' => 'Jeff Dupont',
			'email' => 'jeff.dupont@gmail.com',
			'password' => Hash::make('testing'),
			'status' => UserStatus::ACTIVE,
			'is_admin' => true
		]);
	}

}
