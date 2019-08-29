<?php

use Illuminate\Database\Seeder;

class NationalitiesTableSeeder extends Seeder
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
                'title' => 'Белорус',
                'created_at' => now(),
            ],
            [
                'title' => 'Немец',
                'created_at' => now(),
            ],
            [
                'title' => 'Поляк',
                'created_at' => now(),
            ],
            [
                'title' => 'Русский',
                'created_at' => now(),
            ],
            [
                'title' => 'Украинец',
                'created_at' => now(),
            ],
        ];
        
        DB::table('nationalities')->insert($data);
    }
}
