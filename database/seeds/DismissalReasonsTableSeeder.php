<?php

use Illuminate\Database\Seeder;

class DismissalReasonsTableSeeder extends Seeder
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
        
        DB::table('dismissal_reasons')->insert($data);
    }
}
