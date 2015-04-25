<?php

class BookmakerTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('bookmakers')->truncate();

        $bookmaker = array(
            array(
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'nom' => 'bet365',
                'logo' => 'bet365.png'
            ),
            array(
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'nom' => 'pinnacle',
                'logo' => 'pinnacle.gif'
            ),
            array(
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'nom' => 'sbobet',
                'logo' => 'sbobet.png'
            ),
            array(
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'nom' => 'parionsweb',
                'logo' => 'parionsweb.png'
            ),
        );
        DB::table('bookmakers')->insert($bookmaker);

		// Uncomment the below to run the seeder
	}
}
