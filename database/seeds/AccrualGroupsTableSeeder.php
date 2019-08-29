<?php

use Illuminate\Database\Seeder;

class AccrualGroupsTableSeeder extends Seeder
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
                'title' => 'Все начисления',
                'description' => NULL,
                'type' => '0',
                'created_at' => now(),
            ],
            [
                'title' => 'Все удержания',
                'description' => NULL,
                'type' => '0',
                'created_at' => now(),
            ],
            [
                'title' => 'Все начисления и удержания',
                'description' => 'Все виды начисления и удержания введенные в программу',
                'type' => '0',
                'created_at' => now(),
            ],
            [
                'title' => 'Справка на субсидию',
                'description' => 'Данные виды начисления учитываются при составлении справки для жилищных субсидий',
                'type' => '3',
                'created_at' => now(),
            ],
            [
                'title' => 'Начисления текущего месяца',
                'description' => 'Данные виды удержания сниматюся с з/п текущего месяца, остальные уержания с 1-го месяца долга за предприятием',
                'type' => '2',
                'created_at' => now(),
            ],
            [
                'title' => 'Справка с места работы',
                'description' => 'Данные виды начисления учитываются при составлении справки с места работы',
                'type' => '3',
                'created_at' => now(),
            ],
            [
                'title' => 'Форма 2',
                'description' => 'Данные виды начисления учитываются при составлении формы 2 для налоговой инспекции',
                'type' => '3',
                'created_at' => now(),
            ],
            [
                'title' => 'Форма 3',
                'description' => 'Данные виды начисления учитываются при составлении формы 3 для табельного номера',
                'type' => '3',
                'created_at' => now(),
            ],
            [
                'title' => 'Подоходный налог',
                'description' => 'Вид удержания "Подоходный налог"',
                'type' => '2',
                'created_at' => now(),
            ],
            [
                'title' => 'Обязательные налоги и взносы',
                'description' => 'Обязательные налоги и взносы в государственные фонды',
                'type' => '2',
                'created_at' => now(),
            ],
            [
                'title' => 'Алименты',
                'description' => 'Вид удержания "Алименты"',
                'type' => '3',
                'created_at' => now(),
            ],
            [
                'title' => 'Почтовый сбор',
                'description' => 'Вид удержания "Почтовый сбор"',
                'type' => '3',
                'created_at' => now(),
            ],
            [
                'title' => 'Заработная плата',
                'description' => 'Начисленная зароботная плата работникам',
                'type' => '2',
                'created_at' => now(),
            ],
            [
                'title' => 'Больничные до 5-ти дней',
                'description' => NULL,
                'type' => '2',
                'created_at' => now(),
            ],
            [
                'title' => 'Больничные свыше 5-ти дней',
                'description' => NULL,
                'type' => '2',
                'created_at' => now(),
            ],
            [
                'title' => 'Фонд соцстраха 2.9% с з/платы',
                'description' => NULL,
                'type' => '4',
                'created_at' => now(),
            ],
            [
                'title' => 'Пенсионный фонд 32,3%',
                'description' => NULL,
                'type' => '4',
                'created_at' => now(),
            ],
            [
                'title' => 'Фонд безработицы 1.6%',
                'description' => NULL,
                'type' => '4',
                'created_at' => now(),
            ],
            [
                'title' => 'Фонд страх. от несч.случая 0.9%',
                'description' => NULL,
                'type' => '4',
                'created_at' => now(),
            ],
            [
                'title' => 'Стандартные начисления',
                'description' => NULL,
                'type' => '1',
                'created_at' => now(),
            ],
            [
                'title' => 'Средняя заработная плата',
                'description' => 'Начисления которые используются при формировании справки о средней заработной плате работника',
                'type' => '3',
                'created_at' => now(),
            ],
            [
                'title' => 'Единый социальный взнос на ЗП',
                'description' => 'Единый социальный взнос на зарпботную зарплату работников',
                'type' => '4',
                'created_at' => now(),
            ],
            [
                'title' => 'Единый социальный взнос на ГПХ',
                'description' => 'Единый социальный взнос на ГПХ',
                'type' => '4',
                'created_at' => now(),
            ],
            [
                'title' => 'Единый социальный взнос на больничные',
                'description' => 'Единый социальный взнос на больничные',
                'type' => '4',
                'created_at' => now(),
            ],
        ];
        
        DB::table('accrual_groups')->insert($data);
    }
}
