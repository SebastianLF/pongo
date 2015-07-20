<?php

class ScopeTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('scope')->truncate();

		$scope = array(
			'id' => 0,
			'name' => 'Full Event',
		);

		// Uncomment the below to run the seeder
		DB::table('scope')->insert($scope);
	}

}
