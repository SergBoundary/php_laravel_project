<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
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
                'title' => 'Belarussian Ruble',
                'symbol' => 'BYN',
                'created_at' => now(),
            ],
            [
                'title' => 'Euro',
                'symbol' => 'EUR',
                'created_at' => now(),
            ],
            [
                'title' => 'US Dollar',
                'symbol' => 'USD',
                'created_at' => now(),
            ],
            [
                'title' => 'Zloty',
                'symbol' => 'PLN',
                'created_at' => now(),
            ],
        ];
        
        DB::table('currencies')->insert($data);
    }
}
