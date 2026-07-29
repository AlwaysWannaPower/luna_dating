<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FakeUsersSeeder extends Seeder
{
    public function run(): void
    {
        $fakeProfiles = [
            [
                'name' => 'Анастасия',
                'email' => 'fake.anastasia@luna.test',
                'password' => Hash::make('password'),
                'birth_date' => '1999-05-14',
                'gender' => 'female',
                'looking_for' => 'male',
                'city' => 'Москва',
                'bio' => 'Люблю путешествия, йогу и хороший кофе. Ищу интересного собеседника для совместных приключений.',
                'avatar' => null, // public/storage/avatars/anastasia.jpg
            ],
            [
                'name' => 'Елена',
                'email' => 'fake.elena@luna.test',
                'password' => Hash::make('password'),
                'birth_date' => '1994-08-22',
                'gender' => 'female',
                'looking_for' => 'male',
                'city' => 'Санкт-Петербург',
                'bio' => 'Дизайнер интерьеров. Обожаю искусство, выставки и вечерние прогулки по набережным.',
                'avatar' => null,
            ],
            [
                'name' => 'Катерина',
                'email' => 'fake.katerina@luna.test',
                'password' => Hash::make('password'),
                'birth_date' => '1996-11-30',
                'gender' => 'female',
                'looking_for' => 'male',
                'city' => 'Казань',
                'bio' => 'Программист днём, геймер вечером. В реальной жизни тоже люблю активный отдых и горные лыжи.',
                'avatar' => null,
            ],
            [
                'name' => 'Мария',
                'email' => 'fake.maria@luna.test',
                'password' => Hash::make('password'),
                'birth_date' => '1997-03-05',
                'gender' => 'female',
                'looking_for' => 'both',
                'city' => 'Новосибирск',
                'bio' => 'Музыкант и фотограф. Играю на гитаре, снимаю фильмы. Мечтаю объездить всю страну.',
                'avatar' => null,
            ],
            [
                'name' => 'Виктория',
                'email' => 'fake.viktoria@luna.test',
                'password' => Hash::make('password'),
                'birth_date' => '1998-07-18',
                'gender' => 'female',
                'looking_for' => 'male',
                'city' => 'Екатеринбург',
                'bio' => 'Врач-стоматолог, но мечтаю стать поваром. Люблю готовить, пробовать новое и делиться впечатлениями.',
                'avatar' => null,
            ],
            [
                'name' => 'Дарья',
                'email' => 'fake.darya@luna.test',
                'password' => Hash::make('password'),
                'birth_date' => '2000-01-25',
                'gender' => 'female',
                'looking_for' => 'male',
                'city' => 'Ростов-на-Дону',
                'bio' => 'Студентка медицинского университета. Танцую бальные танцы, читаю литературу и верю в настоящую любовь.',
                'avatar' => null,
            ],
            [
                'name' => 'Полина',
                'email' => 'fake.polina@luna.test',
                'password' => Hash::make('password'),
                'birth_date' => '1995-12-10',
                'gender' => 'female',
                'looking_for' => 'male',
                'city' => 'Сочи',
                'bio' => 'Живу у моря, занимаюсь серфингом и дайвингом. Ценю искренность и хорошее чувство юмора.',
                'avatar' => null,
            ],
            [
                'name' => 'Алиса',
                'email' => 'fake.alisa@luna.test',
                'password' => Hash::make('password'),
                'birth_date' => '1993-09-03',
                'gender' => 'female',
                'looking_for' => 'male',
                'city' => 'Краснодар',
                'bio' => 'Фрилансер, пишу статьи и делаю иллюстрации. Люблю кошек, уютные кофейни и дождливую погоду.',
                'avatar' => null,
            ],
            [
                'name' => 'Софья',
                'email' => 'fake.sofya@luna.test',
                'password' => Hash::make('password'),
                'birth_date' => '1999-04-15',
                'gender' => 'female',
                'looking_for' => 'both',
                'city' => 'Владивосток',
                'bio' => 'Переводчик с китайского и японского. Обожала азиатскую культуру ещё со школы — теперь живу этим.',
                'avatar' => null,
            ],
            [
                'name' => 'Александра',
                'email' => 'fake.alexandra@luna.test',
                'password' => Hash::make('password'),
                'birth_date' => '1996-06-20',
                'gender' => 'female',
                'looking_for' => 'male',
                'city' => 'Нижний Новгород',
                'bio' => 'Юрист, но душа к искусству. Хожу на театр, слушаю классическую музыку и мечтаю выучить итальянский.',
                'avatar' => null,
            ],
        ];

        foreach ($fakeProfiles as $profile) {
            $user = User::create($profile);

            // Try to map avatar from public/storage/avatars/
            $filename = Str::slug($profile['name']).'.jpg';
            $filePath = public_path("storage/avatars/{$filename}");

            if (file_exists($filePath)) {
                $relativePath = 'storage/avatars/'.$filename;
                $user->update(['avatar' => $relativePath]);
            }

            // Set age preferences (2 years younger to 5 years older)
            $user->update([
                'age_min' => rand(18, 25),
                'age_max' => rand(30, 36),
            ]);
        }
    }
}
