<?php

use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
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
                'country_id' => 4,
                'title' => 'Брестская область',
                'national_name' => 'Брэсцкая вобласць',
                'number_iso' => 'BY-BR',
                'created_at' => now(),
            ],
            [
                'country_id' => 4,
                'title' => 'Витебская область',
                'national_name' => 'Віцебская вобласць',
                'number_iso' => 'BY-VI',
                'created_at' => now(),
            ],
            [
                'country_id' => 4,
                'title' => 'Гомельская область',
                'national_name' => 'Гомельская вобласць',
                'number_iso' => 'BY-HO',
                'created_at' => now(),
            ],
            [
                'country_id' => 4,
                'title' => 'Гродненская область',
                'national_name' => 'Гродзенская вобласць',
                'number_iso' => 'BY-HR',
                'created_at' => now(),
            ],
            [
                'country_id' => 4,
                'title' => 'Минская область',
                'national_name' => 'Мінская вобласць',
                'number_iso' => 'BY-MI',
                'created_at' => now(),
            ],
            [
                'country_id' => 4,
                'title' => 'Могилёвская область',
                'national_name' => 'Магілёўская вобласць',
                'number_iso' => 'BY-MA',
                'created_at' => now(),
            ],
            [
                'country_id' => 9,
                'title' => 'Баден-Вюртемберг',
                'national_name' => 'Land Baden-Württemberg',
                'number_iso' => 'BW',
                'created_at' => now(),
            ],
            [
                'country_id' => 9,
                'title' => 'Свободное государство Бавария',
                'national_name' => 'Freistaat Bayern',
                'number_iso' => 'BY',
                'created_at' => now(),
            ],
            [
                'country_id' => 9,
                'title' => 'Берлин',
                'national_name' => 'Land Berlin',
                'number_iso' => 'BE',
                'created_at' => now(),
            ],
            [
                'country_id' => 9,
                'title' => 'Бранденбург',
                'national_name' => 'Land Brandenburg',
                'number_iso' => 'BB',
                'created_at' => now(),
            ],
            [
                'country_id' => 9,
                'title' => 'Свободный ганзейский город Бремен',
                'national_name' => 'Freie Hansestadt Bremen',
                'number_iso' => 'HB',
                'created_at' => now(),
            ],
            [
                'country_id' => 9,
                'title' => 'Свободный и ганзейский город Гамбург',
                'national_name' => 'Freie und Hansestadt Hamburg',
                'number_iso' => 'HH',
                'created_at' => now(),
            ],
            [
                'country_id' => 9,
                'title' => 'Гессен',
                'national_name' => 'Land Hessen',
                'number_iso' => 'HE',
                'created_at' => now(),
            ],
            [
                'country_id' => 9,
                'title' => 'Мекленбург-Передняя Померания',
                'national_name' => 'Land Mecklenburg-Vorpommern',
                'number_iso' => 'MV',
                'created_at' => now(),
            ],
            [
                'country_id' => 9,
                'title' => 'Нижняя Саксония',
                'national_name' => 'Land Niedersachsen',
                'number_iso' => 'NI',
                'created_at' => now(),
            ],
            [
                'country_id' => 9,
                'title' => 'Северный Рейн-Вестфалия',
                'national_name' => 'Land Nordrhein-Westfalen',
                'number_iso' => 'NW',
                'created_at' => now(),
            ],
            [
                'country_id' => 9,
                'title' => 'Рейнланд-Пфальц',
                'national_name' => 'Land Rheinland-Pfalz',
                'number_iso' => 'RP',
                'created_at' => now(),
            ],
            [
                'country_id' => 9,
                'title' => 'Саар',
                'national_name' => 'Saarland',
                'number_iso' => 'SL',
                'created_at' => now(),
            ],
            [
                'country_id' => 9,
                'title' => 'Свободное государство Саксония',
                'national_name' => 'Freistaat Sachsen',
                'number_iso' => 'SN',
                'created_at' => now(),
            ],
            [
                'country_id' => 9,
                'title' => 'Саксония-Анхальт',
                'national_name' => 'Land Sachsen-Anhalt',
                'number_iso' => 'ST',
                'created_at' => now(),
            ],
            [
                'country_id' => 9,
                'title' => 'Шлезвиг-Гольштейн',
                'national_name' => 'Land Schleswig-Holstein',
                'number_iso' => 'SH',
                'created_at' => now(),
            ],
            [
                'country_id' => 9,
                'title' => 'Свободное государство Тюрингия',
                'national_name' => 'Freistaat Thüringen',
                'number_iso' => 'TH',
                'created_at' => now(),
            ],
            [
                'country_id' => 26,
                'title' => 'Мазовецкое',
                'national_name' => 'Mazowieckie',
                'number_iso' => 'PL-MZ',
                'created_at' => now(),
            ],
            [
                'country_id' => 26,
                'title' => 'Нижнесилезское',
                'national_name' => 'Dolnośląskie',
                'number_iso' => 'PL-DS',
                'created_at' => now(),
            ],
            [
                'country_id' => 26,
                'title' => 'Куявско-Поморское',
                'national_name' => 'Kujawsko-Pomorskie',
                'number_iso' => 'PL-KP',
                'created_at' => now(),
            ],
            [
                'country_id' => 26,
                'title' => 'Люблинское',
                'national_name' => 'Lubelskie',
                'number_iso' => 'PL-LU',
                'created_at' => now(),
            ],
            [
                'country_id' => 26,
                'title' => 'Любуское',
                'national_name' => 'Lubuskie',
                'number_iso' => 'PL-LB',
                'created_at' => now(),
            ],
            [
                'country_id' => 26,
                'title' => 'Лодзинское',
                'national_name' => 'Łódzkie',
                'number_iso' => 'PL-LD',
                'created_at' => now(),
            ],
            [
                'country_id' => 26,
                'title' => 'Малопольское',
                'national_name' => 'Małopolskie',
                'number_iso' => 'PL-MA',
                'created_at' => now(),
            ],
            [
                'country_id' => 26,
                'title' => 'Опольское',
                'national_name' => 'Opolskie',
                'number_iso' => 'PL-OP',
                'created_at' => now(),
            ],
            [
                'country_id' => 26,
                'title' => 'Подкарпатское',
                'national_name' => 'Podkarpackie',
                'number_iso' => 'PL-PK',
                'created_at' => now(),
            ],
            [
                'country_id' => 26,
                'title' => 'Подляское',
                'national_name' => 'Podlaskie',
                'number_iso' => 'PL-PD',
                'created_at' => now(),
            ],
            [
                'country_id' => 26,
                'title' => 'Поморское',
                'national_name' => 'Pomorskie',
                'number_iso' => 'PL-PM',
                'created_at' => now(),
            ],
            [
                'country_id' => 26,
                'title' => 'Свентокшиское',
                'national_name' => 'Swiętokrzyskie',
                'number_iso' => 'PL-SK',
                'created_at' => now(),
            ],
            [
                'country_id' => 26,
                'title' => 'Силезское',
                'national_name' => 'Śląskie',
                'number_iso' => 'PL-SL',
                'created_at' => now(),
            ],
            [
                'country_id' => 26,
                'title' => 'Великопольское',
                'national_name' => 'Wielkopolskie',
                'number_iso' => 'PL-WP',
                'created_at' => now(),
            ],
            [
                'country_id' => 26,
                'title' => 'Варминьско-Мазурское',
                'national_name' => 'Warmińsko-Mazurskie',
                'number_iso' => 'PL-WN',
                'created_at' => now(),
            ],
            [
                'country_id' => 26,
                'title' => 'Западно-Поморское',
                'national_name' => 'Zachodniopomorskie',
                'number_iso' => 'PL-ZP',
                'created_at' => now(),
            ],
        ];
        
        DB::table('districts')->insert($data);
    }
}
