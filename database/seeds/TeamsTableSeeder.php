<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
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
                'personal_card_id' => 0,
                'title' => 'ОФИС',
                'abbr' => 'ОФИС',
                'user_id' => 14,
                'created_at' => now(),
            ],
            [
                'personal_card_id' => 1,
                'title' => 'Бригада Баранова',
                'abbr' => 'Баранов',
                'user_id' => 14,
                'created_at' => now(),
            ],
            [
                'personal_card_id' => 11,
                'title' => 'Бригада Котылы',
                'abbr' => 'Котыло',
                'user_id' => 14,
                'created_at' => now(),
            ],
        ];
        
        DB::table('teams')->insert($data);
    }
}
