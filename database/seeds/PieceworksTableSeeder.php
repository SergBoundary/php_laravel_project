<?php

use Illuminate\Database\Seeder;

class PieceworksTableSeeder extends Seeder
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
                'team_id' => 3,
                'personal_card_id' => 7,
                'year_id' => 4,
                'month_id' => 10,
                'object_id' => 10,
                'type' => 'РСтена в 3 кирпича',
                'unit' => 'м2',
                'quantity' => 20.00,
                'price' => 15.00,
                'total' => 300.00,
                'created_at' => now(),
            ],
            [
                'user_id' => 14,
                'team_id' => 3,
                'personal_card_id' => 8,
                'year_id' => 4,
                'month_id' => 11,
                'object_id' => 9,
                'type' => 'Бетонный пол',
                'unit' => 'м2',
                'quantity' => 50.00,
                'price' => 14.00,
                'total' => 700.00,
                'created_at' => now(),
            ],
            [
                'user_id' => 14,
                'team_id' => 3,
                'personal_card_id' => 7,
                'year_id' => 4,
                'month_id' => 11,
                'object_id' => 10,
                'type' => 'Стена в 2 кирпича',
                'unit' => 'м2',
                'quantity' => 25.00,
                'price' => 13.00,
                'total' => 325.00,
                'created_at' => now(),
            ],
        ];
        
        DB::table('pieceworks')->insert($data);
    }
}
