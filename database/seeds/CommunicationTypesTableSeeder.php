<?php

use Illuminate\Database\Seeder;

class CommunicationTypesTableSeeder extends Seeder
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
                'title' => 'Телефон',
                'created_at' => now(),
            ],
            [
                'title' => 'Е-мейл',
                'created_at' => now(),
            ],
        ];
        
        DB::table('communication_types')->insert($data);
    }
}
