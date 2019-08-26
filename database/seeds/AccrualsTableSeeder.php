<?php

use Illuminate\Database\Seeder;

class AccrualsTableSeeder extends Seeder
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
        
        DB::table('accruals')->insert($data);
    }
}
