<?php

use Illuminate\Database\Seeder;

class ShoeSizesTableSeeder extends Seeder
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
        
        DB::table('shoe_sizes')->insert($data);
    }
}
