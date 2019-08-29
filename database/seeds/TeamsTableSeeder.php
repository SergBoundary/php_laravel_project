<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
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
                'title' => 'Бригада Игнатоля',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Палешко',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Шевчика',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Федорченко Николая',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Резановича',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Свиридюка',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Корецкого',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Маслова',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Зинкевича',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Бойдича',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Грицкевича',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Сайко',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Приступы',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Шамшорика',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Кирдея',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Гагарина',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Булко',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада подвыконавцы (украинцы)',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Шруб',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Госса',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Стасевича',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Андрановича',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Курлени',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Ломеко',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Труса',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Чеги',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Котыло',
                'created_at' => now(),
            ],
            [
                'title' => 'Бригада Петрова',
                'created_at' => now(),
            ],
        ];
        
        DB::table('teams')->insert($data);
    }
}
