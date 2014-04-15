<?php 

class UsersTableSeeder extends Seeder {
	public function run() {
		DB::table('users')->delete();

		$users = array(
			array(
				'name' => 'Besingamk',
				'password' => Hash::make('a975273'),
				'email' => 'example@example.com'
			)
		);

		DB::table('users')->insert($users);
	}
}