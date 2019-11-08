<?php

use Illuminate\Database\Seeder;

class ClothingSizesTableSeeder extends Seeder
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
                'region' => 'EU',
                'title' => 'XS',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => 'S',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => 'M',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => 'L',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => 'XL',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => 'XXL',
                'created_at' => now(),
            ],
            [
                'region' => 'EU',
                'title' => 'XXXL',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '40',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '42',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '44',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '46',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '48',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '50',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '52',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '54',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '56',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '58',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '60',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '62',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '64',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '66',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '68',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '70',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '72',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '74',
                'created_at' => now(),
            ],
            [
                'region' => 'BY',
                'title' => '76',
                'created_at' => now(),
            ],
        ];
        
        DB::table('clothing_sizes')->insert($data);
    }
}
