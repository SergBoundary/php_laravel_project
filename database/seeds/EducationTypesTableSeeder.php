<?php

use Illuminate\Database\Seeder;

class EducationTypesTableSeeder extends Seeder
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
        
        DB::table('education_types')->insert($data);
    }
}
