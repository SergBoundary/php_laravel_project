<?php

use Illuminate\Database\Seeder;

class PhraseListGroupsTableSeeder extends Seeder
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
        
        DB::table('phrase_list_groups')->insert($data);
    }
}
