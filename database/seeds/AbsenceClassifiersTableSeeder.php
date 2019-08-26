<?php

use Illuminate\Database\Seeder;

class AbsenceClassifiersTableSeeder extends Seeder
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
        
        DB::table('absence_classifiers')->insert($data);
    }
}
