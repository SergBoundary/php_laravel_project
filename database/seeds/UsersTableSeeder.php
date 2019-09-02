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
                'access' => 0,
            ],
            [
                'name' => 'Руководитель',
                'email' => 'sahaty@mail.com',
                'password' => bcrypt('sahaty'),
                'access' => 1,
            ],
            [
                'name' => 'Специалист',
                'email' => 'specialist@mail.com',
                'password' => bcrypt('12345678'),
                'access' => 2,
            ],
            [
                'name' => 'Работник',
                'email' => 'worker@mail.com',
                'password' => bcrypt('123456'),
                'access' => 3,
            ],
        ];
        
        DB::table('users')->insert($data);
    }
}
