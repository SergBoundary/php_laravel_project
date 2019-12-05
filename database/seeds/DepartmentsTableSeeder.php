<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
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
                'title' => 'Будэкспорт',
                'abbr' => 'Будэкспорт',
                'created_at' => now(),
            ],
            [
                'title' => 'POLIKON',
                'abbr' => 'POLIKON',
                'created_at' => now(),
            ],
            [
                'title' => 'Будэкспорт-СК',
                'abbr' => 'Будэкспорт-СК',
                'created_at' => now(),
            ],
            [
                'title' => 'УВОЛЕННЫЕ',
                'abbr' => 'УВОЛЕННЫЕ',
                'created_at' => now(),
            ],
            [
                'title' => 'UKRAINA',
                'abbr' => 'UKRAINA',
                'created_at' => now(),
            ],
            [
                'title' => 'ИТР',
                'abbr' => 'ИТР',
                'created_at' => now(),
            ],
        ];
        
        DB::table('departments')->insert($data);
    }
}
