<?php

use Illuminate\Database\Seeder;

class DismissalReasonsTableSeeder extends Seeder
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
                'title' => 'По собственному желанию',
                'created_at' => now(),
            ],
            [
                'title' => 'Не соответствие занимаемой должности',
                'created_at' => now(),
            ],
            [
                'title' => 'Отсутствие без уважительных причин',
                'created_at' => now(),
            ],
            [
                'title' => 'Пьянка на рабочем месте',
                'created_at' => now(),
            ],
            [
                'title' => 'Хищение имущества',
                'created_at' => now(),
            ],
            [
                'title' => 'Драка на рабочем месте',
                'created_at' => now(),
            ],
        ];
        
        DB::table('dismissal_reasons')->insert($data);
    }
}
