<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $uniqueNames = [
            '林檎',
            'レモン',
            'キウイ',
            'ぶどう',
            'みかん',
        ];

        $uniqueEmails = [
            'user1@example.com',
            'user2@example.com',
            'user3@example.com',
            'user4@example.com',
            'user5@example.com',
        ];

        foreach ($uniqueEmails as $index => $email) {
            User::create([
                'name' => $uniqueNames[$index],
                'email' => $email,
                'password' => Hash::make('pppp0000')
            ]);
        }
    }
}
