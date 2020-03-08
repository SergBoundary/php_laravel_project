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
                'user_id' => 14,
                'personal_card_id' => 0,
                'title' => 'ОФИС',
                'abbr' => 'ОФИС',
                'start' => null,
                'expiry' => null,
                'created_at' => now(),
            ],
            [
                'user_id' => 14,
                'personal_card_id' => 1,
                'title' => 'Бригада Баранова',
                'abbr' => 'Баранов',
                'start' => '2019-10-01',
                'expiry' => null,
                'created_at' => now(),
            ],
            [
                'user_id' => 14,
                'personal_card_id' => 11,
                'title' => 'Бригада Котылы',
                'abbr' => 'Котыло',
                'start' => '2019-09-01',
                'expiry' => null,
                'created_at' => now(),
            ],
        ];
        
        DB::table('teams')->insert($data);
    }
}
