<?php

use Illuminate\Database\Seeder;

class YearsTableSeeder extends Seeder
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
                'number' => '2016',
                'created_at' => now(),
            ],
            [
                'number' => '2017',
                'created_at' => now(),
            ],
            [
                'number' => '2018',
                'created_at' => now(),
            ],
            [
                'number' => '2019',
                'created_at' => now(),
            ],
            [
                'number' => '2020',
                'created_at' => now(),
            ],
            [
                'number' => '2021',
                'created_at' => now(),
            ],
            [
                'number' => '2022',
                'created_at' => now(),
            ],
        ];
        
        DB::table('years')->insert($data);
    }
}
