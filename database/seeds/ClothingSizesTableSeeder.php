<?php

use Illuminate\Database\Seeder;

class ClothingSizesTableSeeder extends Seeder
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
        
        DB::table('clothing_sizes')->insert($data);
    }
}
