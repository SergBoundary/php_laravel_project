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
                'department_group_id' => 1,
                'title' => 'BUDEKSPORT',
                'abbr' => 'BUDEKSPORT',
                'created_at' => now(),
            ],
            [
                'department_group_id' => 1,
                'title' => 'POLIKON',
                'abbr' => 'POLIKON',
                'created_at' => now(),
            ],
            [
                'department_group_id' => 1,
                'title' => 'Будэкспорт-СК',
                'abbr' => 'Будэкспорт-СК',
                'created_at' => now(),
            ],
            [
                'department_group_id' => 1,
                'title' => 'УВОЛЕННЫЕ',
                'abbr' => 'УВОЛЕННЫЕ',
                'created_at' => now(),
            ],
            [
                'department_group_id' => 1,
                'title' => 'UKRAINA',
                'abbr' => 'UKRAINA',
                'created_at' => now(),
            ],
            [
                'department_group_id' => 1,
                'title' => 'ИТР',
                'abbr' => 'ИТР',
                'created_at' => now(),
            ],
        ];
        
        DB::table('departments')->insert($data);
    }
}
