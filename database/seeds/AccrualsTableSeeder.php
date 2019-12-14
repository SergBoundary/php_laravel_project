<?php

use Illuminate\Database\Seeder;

class AccrualsTableSeeder extends Seeder
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
                'personal_card_id' => 7,
                'year_id' => 4,
                'month_id' => 11,
                'accrual_type_id' => 2,
                'amount' => 50.00,
                'created_at' => now(),
            ],
            [
                'user_id' => 14,
                'personal_card_id' => 7,
                'year_id' => 4,
                'month_id' => 11,
                'accrual_type_id' => 3,
                'amount' => 1200.00,
                'created_at' => now(),
            ],
            [
                'user_id' => 14,
                'personal_card_id' => 8,
                'year_id' => 4,
                'month_id' => 11,
                'accrual_type_id' => 3,
                'amount' => 1300.00,
                'created_at' => now(),
            ],
            [
                'user_id' => 14,
                'personal_card_id' => 8,
                'year_id' => 4,
                'month_id' => 11,
                'accrual_type_id' => 2,
                'amount' => 80.00,
                'created_at' => now(),
            ],
        ];
        
        DB::table('accruals')->insert($data);
    }
}
