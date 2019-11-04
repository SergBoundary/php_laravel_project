<?php

use Illuminate\Database\Seeder;

class PositionCategoriesTableSeeder extends Seeder
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
                'title' => 'Администрация',
                'created_at' => now(),
            ],
            [
                'title' => 'Производственный участок',
                'created_at' => now(),
            ],
        ];
        
        DB::table('position_categories')->insert($data);
    }
}
