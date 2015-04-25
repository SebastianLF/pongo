<?php

class TipsterTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('tipsters')->truncate();

		$tipster = array(
			array(
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
				'name' => 'rugby betting',
				'montant_par_unite' => '30',
				'indice_unite' => '5',
				'followtype' => 'n',
				'user_id' => '2',
			),
			array(
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
				'name' => 'tennis tips',
				'montant_par_unite' => '20',
				'indice_unite' => '10',
				'followtype' => 'n',
				'user_id' => '2',
			),
		);

		// Uncomment the below to run the seeder
		DB::table('tipsters')->insert($tipster);
	}

}
