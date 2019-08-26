<?php

use Illuminate\Database\Seeder;

class AccrualGroupsTableSeeder extends Seeder
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
        
        DB::table('accrual_groups')->insert($data);
    }
}
