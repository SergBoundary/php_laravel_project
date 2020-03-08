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
        $this->call(MenusesTableSeeder::class);
        $this->call(InterfacesTableSeeder::class);
        $this->call(InterfaceTitlesTableSeeder::class);
		
        $this->call(CountriesTableSeeder::class);
        $this->call(HolidaysTableSeeder::class);
		
        $this->call(MonthsTableSeeder::class);
        $this->call(YearsTableSeeder::class);
		
        //$this->call(CompaniesTableSeeder::class);
        //$this->call(UsersTableSeeder::class);
		
        //$this->call(ObjectsTableSeeder::class);
        //$this->call(DepartmentsTableSeeder::class);
        //$this->call(PositionProfessionsTableSeeder::class);
        //$this->call(PositionsTableSeeder::class);
		
        //$this->call(AccrualTypesTableSeeder::class);
        //$this->call(RetentionTypesTableSeeder::class);
		
        //$this->call(PersonalCardsTableSeeder::class);
        //$this->call(RecruitmentOrdersTableSeeder::class);
        //$this->call(TeamsTableSeeder::class);
		
        //$this->call(AllocationsTableSeeder::class);
        //$this->call(ManningOrdersTableSeeder::class);
        //$this->call(PieceworksTableSeeder::class);
        //$this->call(BaseTimesheetsTableSeeder::class);
        //$this->call(AccrualsTableSeeder::class);
        //$this->call(RetentionsTableSeeder::class);
		
        //$this->call(PayrollsTableSeeder::class);
        //$this->call(PaychecksTableSeeder::class);
    }
}
