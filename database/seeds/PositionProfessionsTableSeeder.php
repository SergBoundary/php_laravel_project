<?php

use Illuminate\Database\Seeder;

class PositionProfessionsTableSeeder extends Seeder
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
        
        DB::table('position_professions')->insert($data);
    }
}
