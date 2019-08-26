<?php

use Illuminate\Database\Seeder;

class PieceworkUnitsTableSeeder extends Seeder
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
        
        DB::table('piecework_units')->insert($data);
    }
}
