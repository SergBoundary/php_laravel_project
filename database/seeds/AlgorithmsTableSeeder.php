<?php

use Illuminate\Database\Seeder;

class AlgorithmsTableSeeder extends Seeder
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
                'title' => 'Сумма',
                'created_at' => now(),
            ],
            [
                'title' => 'Оклад по дням',
                'created_at' => now(),
            ],
            [
                'title' => 'Тариф',
                'created_at' => now(),
            ],
            [
                'title' => 'Сдельно',
                'created_at' => now(),
            ],
            [
                'title' => 'Больничные',
                'created_at' => now(),
            ],
            [
                'title' => 'Отускные',
                'created_at' => now(),
            ],
            [
                'title' => 'Средний за год',
                'created_at' => now(),
            ],
            [
                'title' => 'Средний 2-х мес.',
                'created_at' => now(),
            ],
            [
                'title' => 'Средний прошлого месяца',
                'created_at' => now(),
            ],
            [
                'title' => 'Процент от суммы',
                'created_at' => now(),
            ],
            [
                'title' => 'Депонент',
                'created_at' => now(),
            ],
            [
                'title' => 'Часть от суммы',
                'created_at' => now(),
            ],
            [
                'title' => 'По шкале за месяц',
                'created_at' => now(),
            ],
            [
                'title' => 'Долг на начало месяца',
                'created_at' => now(),
            ],
            [
                'title' => 'Долг на конец месяца',
                'created_at' => now(),
            ],
            [
                'title' => 'Процент от прош.месяца',
                'created_at' => now(),
            ],
            [
                'title' => 'Процент за квартал',
                'created_at' => now(),
            ],
            [
                'title' => 'По шкале итог',
                'created_at' => now(),
            ],
            [
                'title' => 'Оклад по часам',
                'created_at' => now(),
            ],
            [
                'title' => 'Подоходный по шкале месяц',
                'created_at' => now(),
            ],
            [
                'title' => 'Подоходный по шкале итого',
                'created_at' => now(),
            ],
            [
                'title' => 'Процент от тарифа',
                'created_at' => now(),
            ],
            [
                'title' => 'Доплата до мин.зп.',
                'created_at' => now(),
            ],
        ];
        
        DB::table('algorithms')->insert($data);
    }
}
