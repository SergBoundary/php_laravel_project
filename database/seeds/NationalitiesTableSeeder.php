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
                'title' => 'Белорусская',
                'created_at' => now(),
            ],
            [
                'title' => 'Немецкая',
                'created_at' => now(),
            ],
            [
                'title' => 'Польская',
                'created_at' => now(),
            ],
            [
                'title' => 'Русская',
                'created_at' => now(),
            ],
            [
                'title' => 'Украинская',
                'created_at' => now(),
            ],
        ];
        
        DB::table('nationalities')->insert($data);
    }
}
