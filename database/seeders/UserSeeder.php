<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('12345678');

        for ($i = 0; $i < 20; $i++) {
            User::insert(
                [
                    'name' => Str::random(10),
                    'email' => Str::random(10) . '@gmail.com',
                    'password' => $password
                ]
            );
        }
    }
}
