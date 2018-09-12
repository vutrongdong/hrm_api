<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call('UserSeeder');
    	$this->call('CitiesTableSeeder');
        $this->call('DistrictsTableSeeder');
        $this->call('WardsTableSeeder');
        $this->call('SettingsTableSeeder');
        $this->call('BranchesTableSeeder');
        $this->call('DepartmentsTableSeeder');
    	$this->call('PositionsTableSeeder');
    }
}
