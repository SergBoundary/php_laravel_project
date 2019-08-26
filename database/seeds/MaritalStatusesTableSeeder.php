<?php

use Illuminate\Database\Seeder;

class MaritalStatusesTableSeeder extends Seeder
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
        
        DB::table('marital_statuses')->insert($data);
    }
}
