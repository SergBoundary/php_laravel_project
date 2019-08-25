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
                'number' => '933',
                'created_at' => now(),
            ],
            [
                'title' => 'Euro',
                'symbol' => 'EUR',
                'number' => '978',
                'created_at' => now(),
            ],
            [
                'title' => 'US Dollar',
                'symbol' => 'USD',
                'number' => '840',
                'created_at' => now(),
            ],
            [
                'title' => 'Zloty',
                'symbol' => 'PLN',
                'number' => '985',
                'created_at' => now(),
            ],
        ];
        
        DB::table('currencies')->insert($data);
    }
}
