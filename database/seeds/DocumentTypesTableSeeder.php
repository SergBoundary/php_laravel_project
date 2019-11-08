<?php

use Illuminate\Database\Seeder;

class DocumentTypesTableSeeder extends Seeder
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
                'title' => 'Приказ приеме на работу',
                'abbr' => 'ПП',
                'standart_status' => 0,
                'prefix_number' => 'ПП0',
                'created_at' => now(),
            ],
            [
                'title' => 'Приказ об увольнении',
                'abbr' => 'ПУ',
                'standart_status' => 0,
                'prefix_number' => 'ПУ0',
                'created_at' => now(),
            ],
            [
                'title' => 'Приказ о назначении на дожность',
                'abbr' => 'ПНД',
                'standart_status' => 0,
                'prefix_number' => 'ПНД0',
                'created_at' => now(),
            ],
            [
                'title' => 'Приказ о снятии с должности',
                'abbr' => 'ПСД',
                'standart_status' => 0,
                'prefix_number' => 'ПСД0',
                'created_at' => now(),
            ],
            [
                'title' => 'Приказ о переводе на другое место работы',
                'abbr' => 'ПСМ',
                'standart_status' => 0,
                'prefix_number' => 'ПСМ0',
                'created_at' => now(),
            ],
        ];
        
        DB::table('document_types')->insert($data);
    }
}
