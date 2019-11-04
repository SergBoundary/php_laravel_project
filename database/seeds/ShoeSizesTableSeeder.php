<?php

use Illuminate\Database\Seeder;

class ShoeSizesTableSeeder extends Seeder
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
                'region' => 'BY',
                'title' => '35',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '36',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '37',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '38',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '39',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '40',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '41',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '42',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '43',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '44',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '45',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '46',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '47',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '48',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '49',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '50',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => '35',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => '36',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => '37',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => '38',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => '39',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => '40',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => '41',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => '42',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => '43',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => '44',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => '45',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => '46',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => '47',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => '48',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => '49',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => '50',
                'created_at' => now(),
            ],
        ];
        
        DB::table('shoe_sizes')->insert($data);
    }
}
