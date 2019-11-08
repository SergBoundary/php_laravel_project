<?php

use Illuminate\Database\Seeder;

class MaritalStatusesTableSeeder extends Seeder
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
                'title' => 'Не связан',
                'created_at' => now(),
            ],
            [
                'title' => 'В гражданском браке',
                'created_at' => now(),
            ],
            [
                'title' => 'В официальном браке',
                'created_at' => now(),
            ],
            [
                'title' => 'В разводе (дети)',
                'created_at' => now(),
            ],
        ];
        
        DB::table('marital_statuses')->insert($data);
    }
}
