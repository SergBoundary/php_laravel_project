<?php

use Illuminate\Database\Seeder;

class FamilyRelationTypesTableSeeder extends Seeder
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
        
        DB::table('family_relation_types')->insert($data);
    }
}
