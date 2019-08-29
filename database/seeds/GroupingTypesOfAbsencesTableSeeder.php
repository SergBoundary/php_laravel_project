<?php

use Illuminate\Database\Seeder;

class GroupingTypesOfAbsencesTableSeeder extends Seeder
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
                'title' => 'Наименование',
                'created_at' => now(),
            ],
            [
                'title' => 'Работа',
                'created_at' => now(),
            ],
            [
                'title' => 'Отпуск основной и дополнительный',
                'created_at' => now(),
            ],
            [
                'title' => 'Отпуск творч., учебный и пр.',
                'created_at' => now(),
            ],
            [
                'title' => 'Отпуск без сохр. з/п',
                'created_at' => now(),
            ],
            [
                'title' => 'Другие отпуск без сохр. з/п',
                'created_at' => now(),
            ],
            [
                'title' => 'Перевод на неполный рабочий день',
                'created_at' => now(),
            ],
            [
                'title' => 'Временный перевод на другое предприятие',
                'created_at' => now(),
            ],
            [
                'title' => 'Простой',
                'created_at' => now(),
            ],
            [
                'title' => 'Прогул',
                'created_at' => now(),
            ],
            [
                'title' => 'Страйк',
                'created_at' => now(),
            ],
            [
                'title' => 'Временная нетрудоспособность(болезнь)',
                'created_at' => now(),
            ],
            [
                'title' => 'Другие',
                'created_at' => now(),
            ],
            [
                'title' => 'Выходные',
                'created_at' => now(),
            ],
            [
                'title' => 'Отпуск по бер. и родам',
                'created_at' => now(),
            ],
        ];
        
        DB::table('grouping_types_of_absences')->insert($data);
    }
}
