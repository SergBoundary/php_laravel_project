<?php

use Illuminate\Database\Seeder;

class DepartmentGroupsTableSeeder extends Seeder
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
        
        DB::table('department_groups')->insert($data);
    }
}
