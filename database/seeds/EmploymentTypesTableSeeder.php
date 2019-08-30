<?php

use Illuminate\Database\Seeder;

class EmploymentTypesTableSeeder extends Seeder
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
                'title' => 'Основная',
                'created_at' => now(),
            ],
            [
                'title' => 'Совместитель',
                'created_at' => now(),
            ],
            [
                'title' => 'Трудовое соглашение',
                'created_at' => now(),
            ],
        ];
        
        DB::table('employment_types')->insert($data);
    }
}
