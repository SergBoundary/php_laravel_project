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
                'name' => 'Баранов Анатолий Владимир',
                'email' => 'baranau.anatol@sk-bud.eu',
                'personal_account' => 'СКЗК-00010',
                'password' => bcrypt('СКЗК-00010'),
                'access' => 3,
                'photo_url' => '/img/1.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Давыдик Вероника Александровна',
                'email' => 'davydzik.veranika@sk-bud.eu',
                'personal_account' => 'СКЗК-00002',
                'password' => bcrypt('СКЗК-00002'),
                'access' => 4,
                'photo_url' => '/img/4.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Девиск Сергей Васильевич',
                'email' => 'devisk.siarhei@sk-bud.eu',
                'personal_account' => 'СКЗК-00012',
                'password' => bcrypt('СКЗК-00012'),
                'access' => 4,
                'photo_url' => '/img/2.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Зайцев Сергей Эдуардович',
                'email' => 'zaitsau.siarhei@sk-bud.eu',
                'personal_account' => 'СКЗК-00016',
                'password' => bcrypt('СКЗК-00016'),
                'access' => 4,
                'photo_url' => '/img/5.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Кирикович Семён Владимирович',
                'email' => 'kirykovich.siamen.dir@sk-bud.eu',
                'personal_account' => 'СКЗК-00001',
                'password' => bcrypt('СКЗК-00001'),
                'access' => 1,
                'photo_url' => '/img/2.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Колин Владимир Сергеевич ',
                'email' => 'kolin.uladzimir@sk-bud.eu',
                'personal_account' => 'СКЗК-00021',
                'password' => bcrypt('СКЗК-00021'),
                'access' => 4,
                'photo_url' => '/img/1.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Колин Сергей Сергеевич',
                'email' => 'kolin.siarhei@sk-bud.eu',
                'personal_account' => 'СКЗК-00022',
                'password' => bcrypt('СКЗК-00022'),
                'access' => 4,
                'photo_url' => '/img/2.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Котыло Андрей Иванович',
                'email' => 'katyla.andrei@sk-bud.eu',
                'personal_account' => '76',
                'password' => bcrypt('76'),
                'access' => 3,
                'photo_url' => '/img/5.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Скробот Александр Васильевич',
                'email' => 'skrobat.aliaksandr@sk-bud.eu',
                'personal_account' => 'СКЗК-00013',
                'password' => bcrypt('СКЗК-00013'),
                'access' => 4,
                'photo_url' => '/img/2.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Солянов Николай Викторович',
                'email' => 'salianau.mikalai@sk-bud.eu',
                'personal_account' => 'СКЗК-00043',
                'password' => bcrypt('СКЗК-00043'),
                'access' => 4,
                'photo_url' => '/img/1.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Яковлюк Геннадий Николаевич',
                'email' => 'yakauliuk.henadzi@sk-bud.eu',
                'personal_account' => 'СКЗК-00009',
                'password' => bcrypt('СКЗК-00009'),
                'access' => 4,
                'photo_url' => '/img/5.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Труханович Роман Андреевич',
                'email' => 'trukhanovich.raman@sk-bud.eu',
                'personal_account' => '381',
                'password' => bcrypt('381'),
                'access' => 2,
                'photo_url' => '/img/2.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Давыдик Дмитрий Юрьевич',
                'email' => 'davydzik.dzmitry@sk-bud.eu',
                'personal_account' => '377',
                'password' => bcrypt('377'),
                'access' => 2,
                'photo_url' => '/img/1.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Бондаренко Сергей Викторович',
                'email' => 'prog.sebo@gmail.com',
                'personal_account' => 'admin',
                'password' => bcrypt('admin'),
                'access' => 0,
                'photo_url' => '/img/5.jpg',
                'created_at' => now(),
            ],
        ];
        
        DB::table('users')->insert($data);
    }
}
