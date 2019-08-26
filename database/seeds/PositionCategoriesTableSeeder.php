<?php

use Illuminate\Database\Seeder;

class PositionCategoriesTableSeeder extends Seeder
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
        
        DB::table('position_categories')->insert($data);
    }
}
