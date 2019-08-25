<?php

use Illuminate\Database\Seeder;

class MonthsTableSeeder extends Seeder
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
                'number' => 1,
                'title' => 'Январь',
                'created_at' => now(),
            ],
            [
                'number' => 2,
                'title' => 'Февраль',
                'created_at' => now(),
            ],
            [
                'number' => 3,
                'title' => 'Март',
                'created_at' => now(),
            ],
            [
                'number' => 4,
                'title' => 'Апрель',
                'created_at' => now(),
            ],
            [
                'number' => 5,
                'title' => 'Май',
                'created_at' => now(),
            ],
            [
                'number' => 6,
                'title' => 'Июнь',
                'created_at' => now(),
            ],
            [
                'number' => 7,
                'title' => 'Июль',
                'created_at' => now(),
            ],
            [
                'number' => 8,
                'title' => 'Август',
                'created_at' => now(),
            ],
            [
                'number' => 9,
                'title' => 'Сентябрь',
                'created_at' => now(),
            ],
            [
                'number' => 10,
                'title' => 'Октябрь',
                'created_at' => now(),
            ],
            [
                'number' => 11,
                'title' => 'Ноябрь',
                'created_at' => now(),
            ],
            [
                'number' => 12,
                'title' => 'Декабрь',
                'created_at' => now(),
            ],
        ];
        
        DB::table('months')->insert($data);
    }
}
