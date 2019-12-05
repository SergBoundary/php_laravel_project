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
                'title' => 'Арматурщик',
                'created_at' => now(),
            ],
            [
                'title' => 'Арматурщик-монтажник',
                'created_at' => now(),
            ],
            [
                'title' => 'Бетонщик',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригадир',
                'created_at' => now(),
            ],
            [
                'title' => 'Главный бухгалтер',
                'created_at' => now(),
            ],
            [
                'title' => 'Директор',
                'created_at' => now(),
            ],
            [
                'title' => 'Зам. по запутанным вопросам',
                'created_at' => now(),
            ],
            [
                'title' => 'Звеневой',
                'created_at' => now(),
            ],
            [
                'title' => 'Инженер',
                'created_at' => now(),
            ],
            [
                'title' => 'Каменщик',
                'created_at' => now(),
            ],
            [
                'title' => 'Кровельщик',
                'created_at' => now(),
            ],
            [
                'title' => 'Маляр',
                'created_at' => now(),
            ],
            [
                'title' => 'Мастер',
                'created_at' => now(),
            ],
            [
                'title' => 'Мастер/инженер',
                'created_at' => now(),
            ],
            [
                'title' => 'Монтажник',
                'created_at' => now(),
            ],
            [
                'title' => 'Монтажник-арматурщик',
                'created_at' => now(),
            ],
            [
                'title' => 'Начальник отдела снабжения',
                'created_at' => now(),
            ],
            [
                'title' => 'Общестроительные работы',
                'created_at' => now(),
            ],
            [
                'title' => 'Отдел снабжения',
                'created_at' => now(),
            ],
            [
                'title' => 'Отделочник',
                'created_at' => now(),
            ],
            [
                'title' => 'Плиточник',
                'created_at' => now(),
            ],
            [
                'title' => 'Плотник',
                'created_at' => now(),
            ],
            [
                'title' => 'Плотник-арматурщик',
                'created_at' => now(),
            ],
            [
                'title' => 'Плотник-бетонщик',
                'created_at' => now(),
            ],
            [
                'title' => 'Плотник-монтажник',
                'created_at' => now(),
            ],
            [
                'title' => 'Подсобный рабочий',
                'created_at' => now(),
            ],
            [
                'title' => 'Помощник плиточника',
                'created_at' => now(),
            ],
            [
                'title' => 'Прораб',
                'created_at' => now(),
            ],
            [
                'title' => 'Разнорабочий',
                'created_at' => now(),
            ],
            [
                'title' => 'Стропальщик',
                'created_at' => now(),
            ],
            [
                'title' => 'Экономист',
                'created_at' => now(),
            ],
            [
                'title' => 'Электрик',
                'created_at' => now(),
            ],
            [
                'title' => 'Электрик вспомогательный',
                'created_at' => now(),
            ],
        ];
        
        DB::table('positions')->insert($data);
    }
}
