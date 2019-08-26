<?php

use Illuminate\Database\Seeder;

class TaxScalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            
        ];
        
        DB::table('tax_scales')->insert($data);
    }
}
