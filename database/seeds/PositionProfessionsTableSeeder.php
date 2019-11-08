<?php

use Illuminate\Database\Seeder;

class PositionProfessionsTableSeeder extends Seeder
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
                'code' => '1114-002-02-0-00',
                'title' => 'Директор',
                'created_at' => now(),
            ],
            [
                'code' => '1211-002-02-0-04',
                'title' => 'Главный бухгалтер',
                'created_at' => now(),
            ],
            [
                'code' => '7122-004-01-3-00',
                'title' => 'Облицовщик плиточник 3 разряда',
                'created_at' => now(),
            ],
            [
                'code' => '2149-022-02-0-00',
                'title' => 'Инженер по охране труда',
                'created_at' => now(),
            ],
            [
                'code' => '1323-041-02-0-00',
                'title' => 'Производитель работ',
                'created_at' => now(),
            ],
            [
                'code' => '7114-006-01-3-00',
                'title' => 'Плотник-бетонщик 3 разряда',
                'created_at' => now(),
            ],
            [
                'code' => '2423-003-02-0-05',
                'title' => 'Ведущий специалист по кадрам',
                'created_at' => now(),
            ],
            [
                'code' => '9313-001-01-2-00',
                'title' => 'Подсобный рабочий 2 разряда',
                'created_at' => now(),
            ],
            [
                'code' => '3333-003-02-0-00',
                'title' => 'Инспектор по кадрам',
                'created_at' => now(),
            ],
            [
                'code' => '7123-003-01-4-00',
                'title' => 'Штукатур 4 разряда',
                'created_at' => now(),
            ],
            [
                'code' => '7131-001-01-5-00',
                'title' => 'Маляр 5 разряда',
                'created_at' => now(),
            ],
            [
                'code' => '1323-018-02-0-00',
                'title' => 'Мастер строительных и монтажных работ',
                'created_at' => now(),
            ],
            [
                'code' => '2149-026-02-0-00',
                'title' => 'Инженер по сметной работе',
                'created_at' => now(),
            ],
            [
                'code' => '7115-005-01-3-00',
                'title' => 'Плотник 3 разряда',
                'created_at' => now(),
            ],
            [
                'code' => '7114-004-01-3-00',
                'title' => 'Бетонщик 3 разряда',
                'created_at' => now(),
            ],
            [
                'code' => '1120-   -00-7-  ',
                'title' => 'Главный инженер',
                'created_at' => now(),
            ],
            [
                'code' => '7123-003-01-3-00',
                'title' => 'Штукатур 3 разряда',
                'created_at' => now(),
            ],
            [
                'code' => '7114-001-01-2-00',
                'title' => 'Арматурщик 2 разряда',
                'created_at' => now(),
            ],
            [
                'code' => '7131-001-01-4-00',
                'title' => 'Маляр 4 разряда',
                'created_at' => now(),
            ],
        ];
        
        DB::table('position_professions')->insert($data);
    }
}
