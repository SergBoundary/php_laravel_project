<?php

use Illuminate\Database\Seeder;

class PhraseListsTableSeeder extends Seeder
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
        
        DB::table('phrase_lists')->insert($data);
    }
}
