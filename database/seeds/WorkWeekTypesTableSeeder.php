<?php

use Illuminate\Database\Seeder;

class WorkWeekTypesTableSeeder extends Seeder
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
                'title' => 'Полная',
                'created_at' => now(),
            ],
            [
                'title' => 'Сокращенная',
                'created_at' => now(),
            ],
            [
                'title' => 'Другое',
                'created_at' => now(),
            ],
        ];
        
        DB::table('work_week_types')->insert($data);
    }
}
