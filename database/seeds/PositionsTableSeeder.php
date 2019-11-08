<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
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
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Арматурщик',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Арматурщик-монтажник',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Бетонщик',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 1,
                'subordination_id' => 6,
                'title' => 'Бригадир',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 1,
                'subordination_id' => 1,
                'title' => 'Директор',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 1,
                'subordination_id' => 2,
                'title' => 'Зам. по запутанным вопросам',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Звеневой',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Каменщик',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Кровельщик',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Маляр',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 1,
                'subordination_id' => 6,
                'title' => 'Мастер',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 1,
                'subordination_id' => 6,
                'title' => 'Мастер/инженер',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Монтажник',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Монтажник-арматурщик',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 1,
                'subordination_id' => 4,
                'title' => 'Начальник отдела снабжения',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Общестроительные работы',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 1,
                'subordination_id' => 5,
                'title' => 'Отдел снабжения',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Отделочник',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 1,
                'subordination_id' => 6,
                'title' => 'Офис',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Плиточник',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Плотник',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Плотник-арматурщик',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Плотник-бетонщик',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Плотник-монтажник',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Подсобный рабочий',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Помощник плиточника',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 1,
                'subordination_id' => 6,
                'title' => 'Прораб',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Разнорабочий',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Стропальщик',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Электрик',
                'created_at' => now(),
            ],
            [
                'position_category_id' => 2,
                'subordination_id' => 7,
                'title' => 'Электрик вспомогательный',
                'created_at' => now(),
            ],
        ];
        
        DB::table('positions')->insert($data);
    }
}
