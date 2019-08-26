<?php

use Illuminate\Database\Seeder;

class PieceworksTableSeeder extends Seeder
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
        
        DB::table('pieceworks')->insert($data);
    }
}
