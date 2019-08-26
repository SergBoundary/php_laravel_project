<?php

use Illuminate\Database\Seeder;

class EmploymentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            
        ];
        
        DB::table('employment_types')->insert($data);
    }
}
