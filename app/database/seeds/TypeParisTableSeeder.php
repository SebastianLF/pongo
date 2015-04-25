<?php

class TypeParisTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('typeparis')->truncate();

		$typeparis = array(
			array(
				'name' => '1X2',
				'description' => 'qsqsd',
			)
		);

		// Uncomment the below to run the seeder
		DB::table('type_paris')->insert($typeparis);
	}

}
