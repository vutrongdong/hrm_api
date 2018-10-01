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
        $this->call('CitiesTableSeeder');
        $this->call('DistrictsTableSeeder');
        // $this->call('WardsTableSeeder');z
        $this->call('SettingsTableSeeder');
        $this->call('BranchesTableSeeder');
        $this->call('DepartmentsTableSeeder');
        $this->call('PositionsTableSeeder');
        $this->call('UserSeeder');
        // $this->call('ContractsTableSeeder');
        $this->call('PlansTableSeeder');
    	$this->call('CandidatesTableSeeder');
    }
}
