<?php

use Illuminate\Database\Seeder;

class GroupingTypesOfAbsencesTableSeeder extends Seeder
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
        
        DB::table('grouping_types_of_absences')->insert($data);
    }
}
