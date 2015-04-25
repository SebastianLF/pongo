<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
        DB::table('users')->delete();
		for($i = 0; $i < 3; ++$i)
		{
			DB::table('users')->insert(array(
					'name' => 'Nom' . $i,
					'email' => 'email' . $i . '@blop.fr',
					'password' => Hash::make('password' . $i),
					'devise' => '€',
				));
		}
	}

}