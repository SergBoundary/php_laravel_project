<?php

use Illuminate\Database\Seeder;

class SubordinationsTableSeeder extends Seeder
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
                'title' => 'Директор',
                'created_at' => now(),
            ],
            [
                'title' => 'Заместитель',
                'created_at' => now(),
            ],
            [
                'title' => 'Главный специалист',
                'created_at' => now(),
            ],
            [
                'title' => 'Начальник отдела',
                'created_at' => now(),
            ],
            [
                'title' => 'Заместитель нач.отдела',
                'created_at' => now(),
            ],
            [
                'title' => 'ИТР',
                'created_at' => now(),
            ],
            [
                'title' => 'Рабочий',
                'created_at' => now(),
            ],
        ];
        
        DB::table('subordinations')->insert($data);
    }
}
