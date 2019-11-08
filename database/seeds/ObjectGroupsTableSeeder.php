<?php

use Illuminate\Database\Seeder;

class ObjectGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'Польша',
                'created_at' => now(),
            ],
            [
                'title' => 'Германия',
                'created_at' => now(),
            ],
        ];
        
        DB::table('object_groups')->insert($data);
    }
}
