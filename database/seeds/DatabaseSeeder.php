<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(GeneratedCountriesTableSeeder::class);
        $this->call(GeneratedStatesTableSeeder::class);
        $this->call(GeneratedLocationsTableSeeder::class);
        $this->call(GeneratedClinicsTableSeeder::class);
        $this->call(GeneratedLocatablesTableSeeder::class);
        $this->call(ContraceptionReasonsTableSeeder::class);
    }
}
