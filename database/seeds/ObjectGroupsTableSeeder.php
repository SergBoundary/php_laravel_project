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
                'title' => 'Важные',
                'created_at' => now(),
            ],
            [
                'title' => 'Крупные',
                'created_at' => now(),
            ],
            [
                'title' => 'Средние',
                'created_at' => now(),
            ],
            [
                'title' => 'Малые',
                'created_at' => now(),
            ],
            [
                'title' => 'Проблемные',
                'created_at' => now(),
            ],
            [
                'title' => 'Собственные',
                'created_at' => now(),
            ],
        ];
        
        DB::table('object_groups')->insert($data);
    }
}
