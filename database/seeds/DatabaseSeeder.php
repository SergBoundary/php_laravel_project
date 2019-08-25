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
        $this->call(UsersTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        
        $this->call(AlgorithmsTableSeeder::class);
        $this->call(ObjectGroupsTableSeeder::class);
        $this->call(ObjectsTableSeeder::class);
        
        $this->call(CountriesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        
        $this->call(CurrenciesTableSeeder::class);
        
        $this->call(MonthsTableSeeder::class);
        $this->call(YearsTableSeeder::class);
    }
}
