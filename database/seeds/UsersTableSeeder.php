<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                'name' => 'Администратор',
                'email' => 'admin@mail.com',
                'password' => bcrypt('admin'),
                'access' => 9,
            ],
            [
                'name' => 'Руководитель',
                'email' => 'sahaty@mail.com',
                'password' => bcrypt('sahaty'),
                'access' => 8,
            ],
            [
                'name' => 'Специалист',
                'email' => 'specialist@mail.com',
                'password' => bcrypt('12345678'),
                'access' => 5,
            ],
            [
                'name' => 'Работник',
                'email' => 'worker@mail.com',
                'password' => bcrypt('123456'),
                'access' => 0,
            ],
        ];
        
        DB::table('users')->insert($data);
    }
}
