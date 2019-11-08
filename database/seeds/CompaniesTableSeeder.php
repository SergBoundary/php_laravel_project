<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
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
                'title' => 'ООО "БУДЭКСПОРТ"',
                'abbr' => 'Будэкспорт',
                'created_at' => now(),
            ],
            [
                'title' => 'ООО "БУДЭКСПОРТ-СК"',
                'abbr' => 'Будэкспорт-СК',
                'created_at' => now(),
            ],
        ];
        
        DB::table('companies')->insert($data);
    }
}
