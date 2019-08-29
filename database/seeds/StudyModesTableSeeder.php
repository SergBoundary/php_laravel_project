<?php

use Illuminate\Database\Seeder;

class StudyModesTableSeeder extends Seeder
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
                'title' => 'Дневная',
                'created_at' => now(),
            ],
            [
                'title' => 'Вечерняя',
                'created_at' => now(),
            ],
            [
                'title' => 'Заочная',
                'created_at' => now(),
            ],
        ];
        
        DB::table('study_modes')->insert($data);
    }
}
