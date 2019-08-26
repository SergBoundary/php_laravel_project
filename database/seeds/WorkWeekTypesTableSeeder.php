<?php

use Illuminate\Database\Seeder;

class WorkWeekTypesTableSeeder extends Seeder
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
        
        DB::table('work_week_types')->insert($data);
    }
}
