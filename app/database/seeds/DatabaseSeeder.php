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
		$this->call('DeviseTableSeeder');
		$this->call('BookmakerTableSeeder');
		$this->call('BookmakerUserTableSeeder');
		$this->call('TipsterTableSeeder');
		$this->call('SportTableSeeder');
		$this->call('CountryTableSeeder');
		$this->call('CompetitionTableSeeder');
		$this->call('EquipeTableSeeder');
		$this->call('EnCoursParisTableSeeder');
		$this->call('SelectionTableSeeder');

		$this->call('CouponTableTableSeeder');
	}

}
