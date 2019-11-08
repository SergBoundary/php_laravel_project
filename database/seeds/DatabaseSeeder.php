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
        
        $this->call(CompaniesTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
        $this->call(CommunicationTypesTableSeeder::class);
        $this->call(SubordinationsTableSeeder::class);
        $this->call(DepartmentGroupsTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
		
        $this->call(PositionCategoriesTableSeeder::class);
        $this->call(PositionProfessionsTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(DismissalReasonsTableSeeder::class);
		
        $this->call(MaritalStatusesTableSeeder::class);
        $this->call(ShoeSizesTableSeeder::class);
        $this->call(ClothingSizesTableSeeder::class);
		
        $this->call(HotelsTableSeeder::class);
        $this->call(HotelConditionsTableSeeder::class);
		
        //$this->call(TeamsTableSeeder::class);
    }
}
