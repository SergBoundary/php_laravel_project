<?php

use Illuminate\Database\Seeder;

class StudyModesTableSeeder extends Seeder
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
        
        DB::table('study_modes')->insert($data);
    }
}
